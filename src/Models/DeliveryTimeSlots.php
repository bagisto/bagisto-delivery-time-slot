<?php

namespace Webkul\DeliveryTimeSlot\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsProxy as SlotsProxy;
use Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlots as DeliveryTimeSlotsContract;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsOrdersProxy as DeliveryTimeSlotsOrders;

class DeliveryTimeSlots extends Model implements DeliveryTimeSlotsContract
{
    /**
     * The table associated with the model.
     */
    protected $table = 'delivery_time_slots';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id', 
        'delivery_date',
        'delivery_day', 
        'start_time', 
        'end_time', 
        'time_delivery_quota', 
        'is_seller',
        'minimum_time_required', 
        'status', 
        'created_at', 
        'updated_at',
    ];

    /**
     * get time slots order.
     * 
     * @return void
     */
    public function time_slot_order()
    {
        return $this->hasOne(DeliveryTimeSlotsOrders::modelClass(), 'id', 'time_slot_id');
    }

    /**
     * Slot.
     * 
     * @return void
     */
    public function slot()
    {
       return $this->hasOne(SlotsProxy::modelClass(), 'id');
    }
}