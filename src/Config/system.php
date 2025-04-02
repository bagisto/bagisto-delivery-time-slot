<?php

return [
    [
        'key'  => 'delivery_time_slot',
        'name' => 'delivery_time_slot::app.admin.system.delivery-time-slot.title',
        'info' => 'delivery_time_slot::app.admin.system.delivery-time-slot.info',
        'sort' => 1,
    ], [
        'key'  => 'delivery_time_slot.settings',
        'name' => 'delivery_time_slot::app.admin.system.setting.title',
        'info' => 'delivery_time_slot::app.admin.system.setting.info',
        'icon' => 'Icon-PWA.svg',
        'sort' => 1,
    ], [
        'key'    => 'delivery_time_slot.settings.general',
        'name'   => 'delivery_time_slot::app.admin.system.delivery-time-setting.title',
        'info'   => 'delivery_time_slot::app.admin.system.delivery-time-setting.info',
        'sort'   => 3,
        'fields' => [
            [
                'name'          => 'enable_time_slot',
                'title'         => 'delivery_time_slot::app.admin.system.enable',
                'type'          => 'boolean',
            ], [
                'name'          => 'allowed_days',
                'title'         => 'delivery_time_slot::app.admin.system.allowed-days',
                'type'          => 'multiselect',
                'repository'    => 'Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository@selectDays',
            ], [
                'name'          => 'total_days',
                'title'         => 'delivery_time_slot::app.admin.system.display-total-days',
                'type'          => 'text',
                'validation'    => 'required|between:1,7',
                'info'          => 'Enter number of days, e.g: 7',
            ], [
                'name'          => 'time_format',
                'title'         => 'delivery_time_slot::app.admin.system.display-time-format',
                'type'          => 'select',
                'validation'    => 'required',
                'repository'    => 'Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository@dateFormat',
            ], [
                'name'          => 'time_slot_error_message',
                'title'         => 'delivery_time_slot::app.admin.system.error-message',
                'type'          => 'textarea',
                'validation'    => 'max:150',
                'locale_based'  => true,
                'channel_based' => true,
            ],
        ],
    ],
];