<?php

namespace Webkul\DeliveryTimeSlot;

use Webkul\Checkout\Facades\Cart as checkoutCart;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository;

class Cart extends checkoutCart 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected DeliveryTimeSlotsRepository $timeSlotsRepository
    ) {
    }

    /**
     * Save shipping method for cart.
     *
     * @param  string  $shippingMethodCode
     */
    public function saveDeliveryMethod($deliveryMethodValue): bool
    {
        $cart = checkoutCart::getCart();
    
        if (! $cart) {
            return false;
        }

       $cart["delivery_time_slots"] = $deliveryMethodValue->id;

       $cart->save();

        return true;
    }

    /**
     * Prepare data for order.
     */
    public function prepareDataForOrder(): array
    {   
        $cart = checkoutCart::getCart();
               
        $selectedSlot = $this->timeSlotsRepository->findOneByField('id', $cart["delivery_time_slots"]);
         
        if ($selectedSlot) {    
            $finalData = [
                'customer_id'   => $cart['customer_id'],
                'time_slot_id'  => $selectedSlot["id"],
                'delivery_date' => $selectedSlot["delivery_date"],
                'order_id'      => $cart['order_id'],
                'delivery_day'  => $selectedSlot['delivery_day'],
                'start_time'    => $selectedSlot['start_time'],
                'end_time'      => $selectedSlot['end_time'],
            ];

            return $finalData;
        }
        
        return [];
    }
}