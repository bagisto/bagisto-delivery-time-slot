<?php

namespace Webkul\DeliveryTimeSlot\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Sales\Models\OrderItemProxy;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsProxy as DeliveryTimeSlots;
use Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlotsOrders as DeliveryTimeSlotsOrdersContract;

class DeliveryTimeSlotsOrders extends Model implements DeliveryTimeSlotsOrdersContract
{
    protected $table = 'delivery_time_slots_orders';

    protected $fillable = ['id', 'time_slot_id', 'delivery_date', 'order_id','customer_id'];


    //get time slots
    public function time_slot()
    {
        return $this->hasOne(DeliveryTimeSlots::modelClass(), 'id', 'time_slot_id');
    }

    //get time slots
    public function items()
    {
        return $this->hasMany(OrderItemProxy::modelClass(), 'order_id')->whereNull('parent_id');
    }

}