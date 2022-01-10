<?php

namespace Webkul\DeliveryTimeSlot\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsProxy as SlotsProxy;
use Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlots as DeliveryTimeSlotsContract;
use Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsOrdersProxy as DeliveryTimeSlotsOrders;

class DeliveryTimeSlots extends Model implements DeliveryTimeSlotsContract
{
    protected $table = 'delivery_time_slots';

    protected $fillable = ['id', 'delivery_day', 'start_time', 'end_time', 'time_delivery_quota', 'is_seller','minimum_time_required', 'status', 'created_at', 'updated_at'];

     //get time slots
     public function time_slot_order()
     {
         return $this->hasOne(DeliveryTimeSlotsOrders::modelClass(), 'id', 'time_slot_id');
     }

     //slot
     public function slot()
     {
         return $this->hasOne(SlotsProxy::modelClass(), 'id');
     }
}