<?php


return [
    [
        'key'       => 'delivery_time_slot',
        'name'      => 'delivery-time-slot::app.admin.system.delivery-time-slot',
        'sort'      => 6
    ], [
        'key'       => 'delivery_time_slot.settings',
        'name'      => 'delivery-time-slot::app.admin.system.setting',
        'sort'      => 1,
    ],  [
        'key'       => 'delivery_time_slot.settings.general',
        'name'      => 'delivery-time-slot::app.admin.system.delivery-time-setting',
        'sort'      => 3,
        'fields'    => [
            [
                'name'          => 'status',
                'title'         => 'delivery-time-slot::app.admin.system.enable',
                'type'          => 'boolean',
                'locale_based'  => true,
                'channel_based' => false,
            ], [
                'name'          => 'allowed_days',
                'title'         => 'delivery-time-slot::app.admin.system.allowed-days',
                'type'          => 'multiselect',
                'locale_based'  => true,
                'channel_based' => false,
                'repository'    => 'Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository@selectDays'
              ], [
                'name'          => 'total_days',
                'title'         => 'delivery-time-slot::app.admin.system.display-total-days',
                'type'          => 'text',
                'validation'    => 'numeric',
                'locale_based'  => true,
                'channel_based' => false,
                'info'          => 'Enter number of days, e.g: 7'
              ],[
                'name'          => 'time_slot_error_message',
                'title'         => 'delivery-time-slot::app.admin.system.error-message',
                'type'          => 'textarea',
                'channel_based' => true,
                'locale_based'  => true
            ]
        ]
    ]
];
