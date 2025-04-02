<?php

return [
    [
        'key'   => 'delivery_time_slot',
        'name'  => 'delivery_time_slot::app.admin.delivery-time-slot.title',
        'route' => 'admin.timeslot.index',
        'sort'  =>  3,
        'icon'  => 'delivery-time-slot-icon',
    ], [
        'key'   => 'delivery_time_slot.index',
        'name'  => 'delivery_time_slot::app.admin.delivery-time-slot.default-delivery-time',
        'route' => 'admin.timeslot.index',
        'sort'  => 1,
    ], [
        'key'   => 'delivery_time_slot.order_slots',
        'name'  => 'delivery_time_slot::app.admin.delivery-time-slot.delivery-orders',
        'route' => 'admin.timeslot.delivery.orders',
        'sort'  => 3,
    ],
];