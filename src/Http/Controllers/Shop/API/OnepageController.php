<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Shop\API;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;
use Webkul\Checkout\Facades\Cart;
use Webkul\Payment\Facades\Payment;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Shop\Http\Resources\CartResource;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\DeliveryTimeSlot\Cart as deliveryCart;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Shop\Http\Requests\Customer\CustomerAddressForm;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;
use Webkul\DeliveryTimeSlot\Repositories\OrderRepository as TimeSlotOrderRepository;
use Webkul\Shop\Http\Controllers\API\OnepageController as BaseOnepageController;

class OnepageController extends BaseOnepageController
{ 
    /**
     * Default Message.
     * @var string
     */
    protected $defaultMessage;

    /**
     * Get Selected Days
     * @var string
     */
    protected $selectedDays;

    /**
     * Default Date Format
     * @var string
     */
    protected $timeFormat;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected CustomerRepository $customerRepository,
        protected DeliveryTimeSlotsRepository $timeSlotsRepository,
        protected DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository,
        protected TimeSlotOrderRepository $timeSlotOrderRepository,
        protected deliveryCart $deliveryCart,
    ) {
        $this->timeFormat = core()->getConfigData('delivery_time_slot.settings.general.time_format');

        $this->defaultMessage = core()->getConfigData('delivery_time_slot.settings.general.time_slot_error_message');
        
        $this->selectedDays = core()->getConfigData('delivery_time_slot.settings.general.allowed_days');
    }

    /**
     * Return order short summary.
     */
    public function summary(): JsonResource
    {
        $cart = Cart::getCart();

        return new CartResource($cart);
    }

    /**
     * Store customer address.
     */
    public function storeAddress(CustomerAddressForm $request): JsonResource
    {  
        $data = $request->all();  

        if (
            ! auth()->guard('customer')->check()
            && ! Cart::getCart()->hasGuestCheckoutItems()
        ) {
            return new JsonResource([
                'redirect' => true,
                'data'     => route('shop.customer.session.index'),
            ]);
        }

        $data['billing']['address1'] = implode(PHP_EOL, $data['billing']['address1']);

        $data['shipping']['address1'] = implode(PHP_EOL, $data['shipping']['address1']);

        if (
            Cart::hasError()
            || ! Cart::saveCustomerAddress($data)
        ) {
            return new JsonResource([
                'redirect' => true,
                'data'     => route('shop.checkout.cart.index'),
            ]);
        }

        $cart = Cart::getCart();
       
        Cart::collectTotals();

        if ($cart->haveStockableItems()) {
            if (! $rates = Shipping::collectRates()) {
                return new JsonResource([
                    'redirect' => true,
                    'data'     => route('shop.checkout.cart.index'),
                ]);
            }

            if ($timeSlotData = $this->getDeliveryTimeSlots()) {
                $rates['sellersTimeSlots'] = $timeSlotData;
            }

            return new JsonResource([
                'redirect'  => false,
                'data'      => $rates,
            ]);
        } 

        return new JsonResource([
            'redirect' => false,
            'data'     => Payment::getSupportedPaymentMethods(),
        ]);
    }

    /**
     * Get Time Slots.
     * 
     * @return array
     */
    private function getDeliveryTimeSlots() 
    {
        $timeSlots = [];

        $message = trans('delivery_time_slot::app.shop.checkout.message');

        $totalDaysCountByAdmin = (int)core()->getConfigData('delivery_time_slot.settings.general.total_days');

        $adminSlots = $this->timeSlotsRepository->findWhere([
            'status' => 1,
        ])->toArray();

        if (empty($adminSlots)) {
            if (! empty($this->defaultMessage)) {
                $message = $this->defaultMessage ;
            }
              
            $timeSlots['SlotsNotAvailable'] = true;

            $timeSlots['message'] = $message;

            return $timeSlots;
        }

        /** Admin time slots */
        foreach ($adminSlots as $adminSlot) {
            $minimumRequiredTime = $this->timeSlotsRepository->findWhere([
                'delivery_day' => $adminSlot['delivery_day'],
                'status'       => 1,
            ])->last();

            $minimumTime = $minimumRequiredTime->minimum_time_required;

            $timeSlotDate = Carbon::parse(date('Y-m-d'))->addDays($minimumTime)->format('Y-m-d');
      
            if ($timeSlotDate <= $adminSlot['delivery_date']) {
                $timeSlots['Slots'][] = $adminSlot;

                $timeSlots['SlotsNotAvailable'] = false;
            }
        }

        $slots = [];

        $dateArray = [];

        $adminAllowedDays = explode(',', $this->selectedDays);
        
        foreach ($timeSlots['Slots'] ?? [] as $timeSlot) {
           if (in_array($timeSlot['delivery_day'], $adminAllowedDays)) {
               $slots[] = $timeSlot;

               $dateArray[] = $timeSlot['delivery_date'];
           }
        }

        sort($dateArray);

        if (count($slots) > $totalDaysCountByAdmin) {
            $noOfDays = count($slots) - $totalDaysCountByAdmin;

            for ($i = 0; $i < $noOfDays; $i++) {
                array_pop($dateArray);
            }
        }

        $filteredSlots = [];

        foreach ($slots as $slot) {
            if (in_array($slot['delivery_date'], $dateArray)) {
                $filteredSlots[] = $slot;
            }
        }

        $finalTimeSlots = [];

       foreach ($filteredSlots as $timeSlot) {
            $timeSlot['delivery_day'] = ucfirst($timeSlot['delivery_day']);

            $timeSlot['delivery_date'] = Carbon::parse($timeSlot['delivery_date'])->format('F d, Y');
             
            $timeStamp1 = strtotime($timeSlot['start_time']);

            $timeStamp2 = strtotime($timeSlot['end_time']);

            $timeSlot['start_time'] = date('H:i A', $timeStamp1);

            $timeSlot['end_time'] = date('H:i A', $timeStamp2);
         
            if ($this->timeFormat == "12 hours") { 
                $timeSlot['start_time'] = date('h:i A', $timeStamp1);

                $timeSlot['end_time'] = date('h:i A', $timeStamp2);  
            }

            $deliveryQuotasCount = $this->deliveryTimeSlotsOrdersRepository->findWhere([
                'time_slot_id' => $timeSlot['id'],
            ])->count();

            $timeSlot['quota']= $deliveryQuotasCount;

            $index = [
                $timeSlot['delivery_day'], 
                $timeSlot['delivery_date']
            ];

            $formattedIndex = implode('/',  $index);

            $finalTimeSlots['slots'][$formattedIndex][] = $timeSlot;

            $finalTimeSlots['SlotsNotAvailable'] = $timeSlots['SlotsNotAvailable'];
        }

        if (empty($finalTimeSlots)) {
            if (! empty( $this->defaultMessage )) {
                $message = $this->defaultMessage ;
            }

            $timeSlots['SlotsNotAvailable'] = true;

            $timeSlots['message'] = $message;

            $finalTimeSlots = $timeSlots;
        }
    
        return $finalTimeSlots;
    }

    /**
     * Store delivery method.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeDeliveryTime()
    {
        $deliveryTimeSlotId = request()->get('deliverySlotId');

        $deliveryTimeSlot = $this->timeSlotsRepository->findOneByField('id', $deliveryTimeSlotId);

        if (
            Cart::hasError()
            || ! $deliveryTimeSlotId
            || !  $this->deliveryCart->saveDeliveryMethod($deliveryTimeSlot)
        ) {
            return response()->json([
                'redirect_url' => route('shop.checkout.cart.index'),
            ], Response::HTTP_FORBIDDEN);
        }

        Cart::collectTotals();

        return response()->json(Payment::getSupportedPaymentMethods());
    }

    /**
     * Store order
     */
    public function storeOrder(): JsonResource
    {
        if (Cart::hasError()) {
            return new JsonResource([
                'redirect'     => true,
                'redirect_url' => route('shop.checkout.cart.index'),
            ]);
        }

        Cart::collectTotals();

        $this->validateOrder();

        $cart = Cart::getCart();
           
        if ($redirectUrl = Payment::getRedirectUrl($cart)) {
            return new JsonResource([
                'redirect'     => true,
                'redirect_url' => $redirectUrl,
            ]);
        }

        $order = $this->orderRepository->create(Cart::prepareDataForOrder());;
    
        if (core()->getConfigData('delivery_time_slot.settings.general.enable_time_slot')) {
            $deliveryCart = $this->deliveryCart->prepareDataForOrder() ?? null;

            $deliveryCart['order_id'] = $order->id;
      
            $this->deliveryTimeSlotsOrdersRepository->create($deliveryCart);
        }

        Cart::deActivateCart();

        Cart::activateCartIfSessionHasDeactivatedCartId();
  
        session()->flash('order', $order);
        
        return new JsonResource([
            'redirect'     => false,
            'redirect_url' => route('shop.checkout.onepage.success'),
        ]);
    }
}