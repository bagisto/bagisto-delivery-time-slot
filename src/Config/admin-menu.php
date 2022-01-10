<?php

return [
    [
        'key'           => 'delivery_time_slot',
        'name'          => 'delivery-time-slot::app.admin.layouts.delivery-time-slots',
        'route'         => 'admin.timeslot.index',
        'sort'          => 3,
        'icon-class'    => 'time-slot-icon',
    ], [
        'key'           => 'delivery_time_slot.deliverytimeslot',
        'name'          => 'delivery-time-slot::app.admin.layouts.default-delivery-time',
        'route'         => 'admin.timeslot.index',
        'sort'          => 1
    ], [
        'key'           => 'delivery_time_slot.timeslots',
        'name'          => 'delivery-time-slot::app.admin.layouts.delivery-time-slots',
        'route'         => 'admin.timeslot.delivery.timeslots',
        'sort'          => 2
    ], [
        'key'           => 'delivery_time_slot.orerslots',
        'name'          => 'delivery-time-slot::app.admin.layouts.delivery-orders',
        'route'         => 'admin.timeslot.delivery.orders',
        'sort'          => 3
    ],
];