<?php

return [
    'shop' => [
        'tracking-number' => 'Tracking Number',
        'layouts' => [
            'delivery-time-slot' => 'Delivery Time Slot',
            'delivery-time-configuration' => 'Time Delivery Configuration',
            'save-btn' => 'Save'
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Time Slots',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'Time Slots Configuration',
            'delivery-order-history' => 'Delivery Order History',
            'minimum-required-time' => 'Minimum Required Time in Order Process:',
            'time-delivery-order' => 'Time Delivery Orders',

            'datagrid' => [
                'delivery-date' => 'Delivery Date',
                'orders' => 'Order#',
                'selected-slot' => 'Selected Slot',
                'purchased-on' => 'Purchased On',
            ],
        ],

        'checkout' => [
            'time-slots' => 'Time Slots',
            'seller' => 'Seller',
            'time' => 'Time',
            'date-day' => 'Date/Day',
            'admin' => 'Admin',

            'cart' => [
                'message' => 'Delivery Time Slots are not available for this product.'
            ]
        ],
    ],

    'admin' => [
        'layouts' => [
            'delivery-time-slot' => 'Delivery Time Slot',
            'default-delivery-time' => 'Default Delivery Time Slots',
            'save-btn' => 'Save Config',
            'select-day' => 'Select Day	',
            'start-time' => 'Start Time',
            'end-time' => 'End Time',
            'quotas' => 'Quotas',
            'delivery-orders' => 'Delivery Orders',
            'delivery-time-slots' => 'Delivery Time Slots',
            'admin-delivery-time-slots' => 'Admin Delivery Time Slots',
            'delivery-slots' => 'Delivery Slots',
            'delete-confirm' => 'Are you sure you want to delete this slot?',
            'start-time-error' => 'Start time should be different for the same delivery day.',

            'btn' => [
                'delete' => 'Delete',
                'add-time-slot' => 'Add Time Slot',
            ],

            'days' => [
                'monday' => 'Monday',
                'tuesday' => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday' => 'Thursday',
                'friday' => 'Friday',
                'saturday' => 'Saturday',
                'sunday' => 'Sunday',
            ],
        ],

        'datagrid' => [
            'seller-name' => 'Seller Name',
            'delivery-date' => 'Delivery Date',
            'order' => 'Order#',
            'delivery-time-from' => 'Delivery Time From',
            'delivery-time-to' => 'Delivery Time To',
            'delivery-orders' => 'Delivery Orders',
            'delivery-time-slots' => 'Delivery Time Slots',
            'end-time' => 'End Time',
            'start-time' => 'Start Time',
            'allowed-orders' => 'Allowed Orders',
            'delivery-day' => 'Delivery Day',
            'action' => 'Actions',
            'order-id' => 'Order ID',
            'customer-name' => 'Customer Name'
        ],

        'system' => [
            'delivery-time-setting' => 'Delivery Time Setting',
            'enable' => 'Enable',
            'allowed-days' => 'Allowed Days',
            'display-total-days' => 'Display Total Days',
            'display-time-format' => 'Display Time Format',
            'minimun-time' => 'Minimum Required Time in Order Process',
            'error-message' => 'Error Message if Time Slots not available.',
            'success-message' => ':name Saved successfully.',
            'setting' => 'Settings',
            'delivery-time-slot' => 'Delivery Time Slot',
            'show-message' => 'Show error message at the shop if slots are not available.'
        ],
    ],
];