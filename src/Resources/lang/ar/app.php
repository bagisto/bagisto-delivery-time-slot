<?php

return [
    'shop' => [
        'tracking-number' => 'عدد تتبع',
        'layouts' => [
            'delivery-time-slot' => 'فتحة وقت التسليم',
            'delivery-time-configuration' => 'تكوين وقت التسليم',
            'save-btn' => 'يحفظ'
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'فتحات الوقت',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'تكوين فترات زمنية',
            'delivery-order-history' => 'تاريخ أمر التسليم',
            'minimum-required-time' => 'الحد الأدنى من الوقت المطلوب في عملية الطلب:',
            'time-delivery-order' => 'أوامر التسليم في الوقت المحدد',

            'datagrid' => [
                'delivery-date' => 'تاريخ التسليم او الوصول',
                'orders' => 'طلب#',
                'selected-slot' => 'الفتحة المحددة',
                'purchased-on' => 'تم شراؤها على',
            ],
        ],

        'checkout' => [
            'time-slots' => 'فتحات الوقت',
            'seller' => 'تاجر',
            'time' => 'وقت',
            'date-day' => 'تاريخ اليوم',
            'admin' => 'مسؤل',

            'cart' => [
                'message' => 'فتحات وقت التسليم غير متوفرة لهذا المنتج.'
            ]
        ],
    ],

    'admin' => [
        'layouts' => [
            'delivery-time-slot' => 'فتحة وقت التسليم',
            'default-delivery-time' => 'خانات وقت التسليم الافتراضية',
            'save-btn' => 'حفظ التكوين',
            'select-day' => 'حدد اليوم',
            'start-time' => 'وقت البدء',
            'end-time' => 'وقت النهاية',
            'quotas' => 'الحصص',
            'delivery-orders' => 'أوامر التسليم',
            'delivery-time-slots' => 'فتحات وقت التسليم',
            'admin-delivery-time-slots' => 'فتحات وقت التسليم المسؤول',
            'delivery-slots' => 'فتحات التسليم',
            'delete-confirm' => 'هل أنت متأكد أنك تريد حذف هذا الفتحة؟',
            'start-time-error' => 'يجب أن يكون وقت البدء مختلفًا لنفس يوم التسليم.',

            'btn' => [
                'delete' => 'يمسح',
                'add-time-slot' => 'أضف فترة زمنية',
            ],

            'days' => [
                'monday' => 'الاثنين',
                'tuesday' => 'يوم الثلاثاء',
                'wednesday' => 'الأربعاء',
                'thursday' => 'يوم الخميس',
                'friday' => 'جمعة',
                'saturday' => 'السبت',
                'sunday' => 'الأحد',
            ],
        ],

        'datagrid' => [
            'seller-name' => 'البائع اسم',
            'delivery-date' => 'تاريخ التسليم او الوصول',
            'order' => 'طلب#',
            'delivery-time-from' => 'وقت التسليم من',
            'delivery-time-to' => 'وقت التسليم إلى',
            'delivery-orders' => 'أوامر التسليم',
            'delivery-time-slots' => 'فتحات وقت التسليم',
            'end-time' => 'وقت النهاية',
            'start-time' => 'وقت البدء',
            'allowed-orders' => 'الطلبات المسموح بها',
            'delivery-day' => 'يوم التوصيل',
            'action' => 'أجراءات',
            'order-id' => 'رقم التعريف الخاص بالطلب',
            'customer-name' => 'اسم الزبون'
        ],

        'system' => [
            'delivery-time-setting' => 'تحديد وقت التسليم',
            'enable' => 'يُمكَِن',
            'allowed-days' => 'الأيام المسموح بها',
            'display-total-days' => 'عرض إجمالي الأيام',
            'display-time-format' => 'تنسيق وقت العرض',
            'minimun-time' => 'الحد الأدنى من الوقت المطلوب في عملية الطلب',
            'error-message' => 'رسالة خطأ في حالة عدم توفر الفترات الزمنية.',
            'success-message' => ':name حفظ بنجاح.',
            'setting' => 'إعدادات',
            'delivery-time-slot' => 'فتحة وقت التسليم',
            'show-message' => 'عرض رسالة خطأ في المتجر إذا لم تكن الفتحات متاحة.'
        ],
    ],
];