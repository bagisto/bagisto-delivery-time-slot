<?php

namespace Webkul\DeliveryTimeSlot\Models;

use Webkul\Sales\Models\OrderItemProxy;
use Webkul\Sales\Models\Order as OrderBaseModel;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsOrders;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsOrdersProxy;

class Order extends OrderBaseModel
{
    /**
     * Get the delieveryInfo associated with order.
     */
    public function deliveryTimeSlotsOrders()
    {
        return $this->hasOne(DeliveryTimeSlotsOrders::class);
    }

    //get time slots
    public function orderItems()
    {
        return $this->hasMany(OrderItemProxy::modelClass(), 'order_id')->whereNull('parent_id');
    }

    //get time slots
    public function orderSlots()
    {
        return $this->hasMany(DeliveryTimeSlotsOrdersProxy::modelClass());
    }
}
