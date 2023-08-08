<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Shop;

use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Checkout\Facades\Cart;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Payment\Facades\Payment;
use Webkul\Checkout\Http\Requests\CustomerAddressForm;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;
use Webkul\DeliveryTimeSlot\Repositories\OrderRepository as DeliveryTimeSlotOrderRepository;

class OnepageController extends Controller
{
    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

     /**
     * customerRepository instance object
     *
     * @var \Webkul\Customer\Repositories\CustomerRepository
     */
    protected $customerRepository;

    /**
    * deliveryTimeSlotConfigArray instance array
    *
    * @var array
    */
    protected $dtsConfigArray = [
        'status'    => false,
        'message'   => '',
        'days'      => 0,
    ];

    /**
     * DeliveryTimeSlotsRepository instance object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository
     */
    protected $deliveryTimeSlotsRepository;

    /**
     * DeliveryTimeSlotsOrdersRepository Instance Object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * DeliveryTimeSlotOrderRepository Instance Object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\OrderRepository
     */
    protected $deliveryTimeSlotOrderRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Attribute\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository  $deliveryTimeSlotsRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository  $deliveryTimeSlotsOrdersRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\OrderRepository    $deliveryTimeSlotOrderRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        CustomerRepository $customerRepository,
        DeliveryTimeSlotsRepository $deliveryTimeSlotsRepository,
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository,
        DeliveryTimeSlotOrderRepository $deliveryTimeSlotOrderRepository
    )
    {
        $this->orderRepository = $orderRepository;

        $this->customerRepository = $customerRepository;

        $this->deliveryTimeSlotsRepository = $deliveryTimeSlotsRepository;

        $this->deliveryTimeSlotsOrdersRepository = $deliveryTimeSlotsOrdersRepository;

        $this->deliveryTimeSlotOrderRepository = $deliveryTimeSlotOrderRepository;

        if ( core()->getConfigData('delivery_time_slot.settings.general.status') ) {
            $this->dtsConfigArray['status'] = core()->getConfigData('delivery_time_slot.settings.general.status');

            $this->dtsConfigArray['message'] = core()->getConfigData('delivery_time_slot.settings.general.time_slot_error_message');

            $this->dtsConfigArray['days'] =  core()->getConfigData('delivery_time_slot.settings.general.allowed_days');
        }

        parent::__construct();
    }

    /**
     * Saves customer address.
     *
     * @param  \Webkul\Checkout\Http\Requests\CustomerAddressForm  $request
     * @return \Illuminate\Http\Response
    */
    public function saveAddress(CustomerAddressForm $request)
    {
        $data = request()->all();

        if (
            ! auth()->guard('customer')->check() &&
            ! Cart::getCart()->hasGuestCheckoutItems()
        ) {
            return response()->json(['redirect_url' => route('customer.session.index')], 403);
        }

        $data['billing']['address1'] = implode(PHP_EOL, array_filter($data['billing']['address1']));
        $data['shipping']['address1'] = implode(PHP_EOL, array_filter($data['shipping']['address1']));

        if (
            Cart::hasError() ||
            ! Cart::saveCustomerAddress($data)
        ) {
            return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
        } else {
            $cart = Cart::getCart();

            Cart::collectTotals();

            if ($cart->haveStockableItems()) {
                if (! $rates = Shipping::collectRates()) {
                    return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
                } else {
                    // Delivery Time Slot Start
                    if ( $this->dtsConfigArray['status'] ) {
                        $rates['sellersTimeSlots'] = $this->deliveryTimeSlotsRepository->getShippingTimeSlots();
                    } // Delivery Time Slot End

                    return response()->json($rates);
                }
            } else {
                return response()->json(Payment::getSupportedPaymentMethods());
            }
        }
    }

    /**
     * Saves payment method.
     *
     * @return \Illuminate\Http\Response
    */
    public function savePayment()
    {
        $payment = request()->get('payment');

        if (
            Cart::hasError() ||
            ! $payment ||
            ! Cart::savePaymentMethod($payment)
        ) {
            return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
        }

        Cart::collectTotals();

        $cart = Cart::getCart();

        // Delivery Time Slot Start
        if ($this->dtsConfigArray['status']) {
            $selectedSlots = [];
            $selectedTimeSlot = request()->get('selected_delivery_slot');

            if (
                isset($selectedTimeSlot) &&
                $selectedTimeSlot
            ) {
                foreach ($selectedTimeSlot as $key => $slot) {

                    $sellerId = NULL;
                    if (
                        isset($slot[1]) &&
                        $slot[1]
                    ) {
                        $sellerId = (int) $slot[1];
                    }

                    $deliveryTimeSlot = $this->deliveryTimeSlotsRepository->find($slot[0]);

                    if (
                        isset($deliveryTimeSlot->id) &&
                        $deliveryTimeSlot->id == $slot[0]
                    ) {
                        $selectedSlots[0]['days'] = $deliveryTimeSlot;
                        $selectedSlots[0]['delivery_date'] = $slot[2] . ',' . $slot['3'] . ',' . $slot[4];
                    }
                }
            }

            session()->put('selected_delivery_slot', request()->selected_delivery_slot);

            return response()->json([
                'jump_to_section' => 'review',
                'html'            => view('shop::checkout.onepage.review', compact('cart', 'selectedSlots'))->render(),
            ]);
        } else {// Delivery Time Slot End

            return response()->json([
                'jump_to_section' => 'review',
                'html'            => view('shop::checkout.onepage.review', compact('cart'))->render(),
            ]);
        }
    }

    /**
     * Saves order.
     *
     * @return \Illuminate\Http\Response
    */
    public function saveOrder()
    {
        if (Cart::hasError()) {
            return response()->json(['redirect_url' => route('shop.checkout.cart.index')], 403);
        }

        Cart::collectTotals();

        $this->validateOrder();

        $cart = Cart::getCart();

        if ($redirectUrl = Payment::getRedirectUrl($cart)) {
            return response()->json([
                'success'      => true,
                'redirect_url' => $redirectUrl,
            ]);
        }

        // Delivery Time Slot Start
        if ($this->dtsConfigArray['status']) {
            $order = $this->deliveryTimeSlotOrderRepository->create(Cart::prepareDataForOrder());
        } else { // Delivery Time Slot End
            $order = $this->orderRepository->create(Cart::prepareDataForOrder());
        }

        Cart::deActivateCart();

        Cart::activateCartIfSessionHasDeactivatedCartId();

        session()->flash('order', $order);

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Validate order before creation
     *
     * @return void|\Exception
     */
    public function validateOrder()
    {
        $cart = Cart::getCart();

        $minimumOrderAmount = core()->getConfigData('sales.orderSettings.minimum-order.minimum_order_amount') ?? 0;

        if (! $cart->checkMinimumOrder()) {
            throw new \Exception(trans('shop::app.checkout.cart.minimum-order-message', ['amount' => core()->currency($minimumOrderAmount)]));
        }

        if (
            $cart->haveStockableItems() &&
            ! $cart->shipping_address
        ) {
            throw new \Exception(trans('Please check shipping address.'));
        }

        if (! $cart->billing_address) {
            throw new \Exception(trans('Please check billing address.'));
        }

        if (
            $cart->haveStockableItems() && 
            ! $cart->selected_shipping_rate
        ) {
            throw new \Exception(trans('Please specify shipping method.'));
        }

        if (! $cart->payment) {
            throw new \Exception(trans('Please specify payment method.'));
        }
    }
}