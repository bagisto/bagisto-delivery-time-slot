<?php

namespace Webkul\DeliveryTimeSlot\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Sales\Models\OrderItemProxy;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsProxy as DeliveryTimeSlots;
use Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlotsOrders as DeliveryTimeSlotsOrdersContract;

class DeliveryTimeSlotsOrders extends Model implements DeliveryTimeSlotsOrdersContract
{
    /**
     * The table associated with the model.
     */
    protected $table = 'delivery_time_slots_orders';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id',
        'time_slot_id',
        'delivery_date',
        'order_id',
        'customer_id',
        'delivery_day',
        'start_time',
        'end_time',
    ];

    /**
     * get time slots.
     * 
     * @return void
     */
    public function time_slot()
    {
        return $this->hasOne(DeliveryTimeSlots::modelClass(), 'id', 'time_slot_id');
    }

    /**
     * get items.
     * 
     * @return void
     */
    public function items()
    {
        return $this->hasMany(OrderItemProxy::modelClass(), 'order_id')->whereNull('parent_id');
    }
}