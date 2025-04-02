<?php

return [
    'shop' => [
        'tracking-number' => 'عدد تتبع',

        'delivery-time-slot' => [
            'title'                       => 'فتحة وقت التسليمt',
            'delivery-time-configuration' => 'تكوين تسليم الوقت',
            'save-btn'                    => 'يحفظ',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'فتحات الوقت',
            ],
        ],

        'checkout' => [
            'time-slots' => 'فتحات وقت التسليم',
            'seller'     => 'تاجر',
            'time'       => 'وقت',
            'date-day'   => 'تاريخ اليوم',
            'admin'      => 'مسؤل',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'فتحة وقت التسليم',
            'default-delivery-time'     => 'فتحات وقت التسليم الافتراضية',
            'save-btn'                  => 'حفظ التكوين',
            'delivery_date'             => 'تاريخ',
            'select-day'                => 'حدد اليوم',
            'start-time'                => 'وقت البدء',
            'end-time'                  => 'وقت النهاية',
            'quotas'                    => 'الحصص',
            'delivery-orders'           => 'أوامر التسليم',
            'delivery-time-slots'       => 'فتحة وقت التسليمts',
            'admin-delivery-time-slots' => 'فتحات وقت تسليم المشرف',
            'delivery-slots'            => 'فتحات التسليم',
            'status'                    => 'حالة',  
            'delete-confirm'            => 'هل أنت متأكد أنك تريد حذف هذه الفتحة؟',
            'true'                      => 'حقيقي',
            'false'                     => 'خطأ شنيع',
            'greater-than'              => 'أكثر من',
            'less-than'                 => 'أقل من',
            'delivery-date-error'       => "التاريخ واليوم لا يتطابقان",
            'delivery-date-day'         => "تاريخ التسليم/اليوم",
            'delivery-time'             => "موعد التسليم",

            'minimum-required-time'     => [
               'title' => 'الحد الأدنى من الأيام المطلوبة لمعالجة الطلب:',
               'info'  => 'أدخل عدد الأيام ، على سبيل المثال: 5',
            ],

            'btn' => [
                'delete'        => 'يمسح',
                'add-time-slot' => 'أضف فتحة الوقت',
            ],

            'days' => [
                'monday'    => 'الاثنين',
                'tuesday'   => 'يوم الثلاثاء',
                'wednesday' => 'الأربعاء',
                'thursday'  => 'يوم الخميس',
                'friday'    => 'جمعة',
                'saturday'  => 'السبت',
                'sunday'    => 'الأحد',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'البائع اسم',
            'delivery-date'       => 'تاريخ التسليم او الوصول',
            'order'               => 'طلب#',
            'delivery-time-from'  => 'وقت التسليم من',
            'delivery-time-to'    => 'وقت التسليم ل',
            'delivery-orders'     => 'أوامر التسليم',
            'delivery-time-slots' => 'فتحات وقت التسليم',
            'end-time'            => 'وقت النهاية',
            'start-time'          => 'وقت البدء',
            'allowed-orders'      => 'أوامر مسموح بها',
            'delivery-day'        => 'يوم التوصيل',
            'action'              => 'أجراءات',
            'order-id'            => 'رقم التعريف الخاص بالطلب',
            'customer-name'       => 'اسم الزبون',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'إعداد وقت التسليم',
                'info'  => 'يتيح لفتح وقت التسليم للعملاء اختيارهم المفضل فتحات الوقت ل
                    التسليم أو الخدمات بناءً على توفرها أو راحتها.',
            ],

            'enable'                => 'يُمكَِن',
            'allowed-days'          => 'أيام مسموح بها',
            'display-total-days'    => 'عرض إجمالي الأيام',
            'dispaly-time-format'   => 'عرض تنسيق وقت',
            'minimun-time'          => 'الحد الأدنى للوقت المطلوب لعملية الطلب',
            'error-message'         => 'رسالة الخطأ إذا كانت فتحات الوقت غير متوفرة.',
            'success-message'       => ': تم حفظ الاسم بنجاح.',

            'setting' => [
                'title' => 'إعدادات',
                'info'  => 'تعيين الخيارات ورسائل الخطأ.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'فتحة وقت التسليم',
                'info'  => 'فتحة وقت التسليم.',
            ],
        ],
    ],
];