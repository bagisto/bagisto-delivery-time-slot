<?php

return [
    'shop' => [
        'tracking-number' => 'Tracking Number',

        'delivery-time-slot' => [
            'title'                       => 'Delivery Time Slot',
            'delivery-time-configuration' => 'Time Delivery Configuration',
            'save-btn'                    => 'Save',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Time Slots',
            ],
        ],
        
        'checkout' => [
            'time-slots' => 'Delivey Time Slots',
            'seller'     => 'Seller',
            'time'       => 'Time',
            'date-day'   => 'Date/Day',
            'admin'      => 'Admin',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Delivery Time Slot',
            'default-delivery-time'     => 'Default Delivery Time Slots',
            'save-btn'                  => 'Save Configuration',
            'delivery_date'             => 'Date',
            'select-date'               => 'Select Date',
            'day'                       => 'Day',
            'start-time'                => 'Start Time',
            'end-time'                  => 'End Time',
            'quotas'                    => 'Quotas',
            'action'                    => 'Action',
            'delivery-orders'           => 'Delivery Orders',
            'delivery-time-slots'       => 'Delivery Time Slots',
            'admin-delivery-time-slots' => 'Admin Delivery Time Slots',
            'delivery-slots'            => 'Delivery Slots',
            'status'                    => 'Status',  
            'delete-confirm'            => 'Are you sure you want to delete this slot?',
            'enable'                    => 'Enable',
            'disable'                   => 'Disable',
            'end-time-exception'        => '*End time should be greater than Start time',
            'start-time-exception'      => '*Start time should be less than end time',
            'delivery-date-error'       => "Date and day doesn't match",
            'delivery-date-day'         => "Delivery Date/Day",
            'delivery-time'             => "Delivery-Time",
            'create-success'            => 'Delivery Time Slots Created.',

            'minimum-required-time' => [
               'title'                  => 'Minimum days required in order processing for shipment',
               'info'                   => 'Enter number of days, e.g: 5',
               'minimum-time-exception' => 'The minimum required time must be  between 1 and 7',
            ],

            'btn' => [
                'delete'        => 'Delete',
                'add-time-slot' => 'Add Time Slot',
            ],

            'days' => [
                'monday'    => 'Monday',
                'tuesday'   => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday'  => 'Thursday',
                'friday'    => 'Friday',
                'saturday'  => 'Saturday',
                'sunday'    => 'Sunday',
            ],

            'errors' => [
                'already-created' => 'Time Slot Already created.',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Seller Name',
            'delivery-date'       => 'Delivery Date',
            'order'               => 'Order#',
            'delivery-time-from'  => 'Delivery Time From',
            'delivery-time-to'    => 'Delivery Time To',
            'delivery-orders'     => 'Delivery Orders',
            'delivery-time-slots' => 'Delivery Time Slots',
            'end-time'            => 'End Time',
            'start-time'          => 'Start Time',
            'allowed-orders'      => 'Allowed Orders',
            'delivery-day'        => 'Delivery Day',
            'action'              => 'Actions',
            'order-id'            => 'Order ID',
            'customer-name'       => 'Customer Name',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Delivery Time Setting',
                'info'  => 'Delivery Time-slot allows customers to select their preferred time slots for 
                    delivery or services based on their availability or convenience.',
            ],

            'enable'                => 'Enable',
            'allowed-days'          => 'Allowed Days',
            'display-total-days'    => 'Display Total Days',
            'dispaly-time-format'   => 'Display Time Format',
            'minimun-time'          => 'Minimum Required Time in Order Process',
            'error-message'         => 'Error Message if Time Slots not available.',
            'success-message'       => ':name Saved successfully.',

            'setting' => [
                'title' => 'Settings',
                'info'  => 'Set configuration setting and error messages for Delivery Time Slot module.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Delivery Time Slot',
                'info'  => 'Delivery Time Slot.',
            ],
        ],
    ],
];