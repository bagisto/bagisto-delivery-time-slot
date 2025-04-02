<?php

return [
    'shop' => [
        'tracking-number' => 'מספר מעקב',

        'delivery-time-slot' => [
            'title'                       => 'משבצת זמן אספקה',
            'delivery-time-configuration' => 'תצורת מסירת זמןn',
            'save-btn'                    => 'להציל',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'חריצי זמן',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'תצורת חריצי זמן',
            'delivery-order-history'  => 'היסטוריית הזמנת משלוח',
            'minimum-required-time'   => 'זמן נדרש מינימלי בתהליך הסדר:',
            'time-delivery-order'     => 'הזמנות משלוח זמן',
            'datagrid'                => [
                'delivery-date' => 'תאריך משלוח',
                'orders'        => 'להזמין#',
                'selected-slot' => 'משבצת נבחרת',
                'purchased-on'  => 'נרכש ב-',
            ],
        ],

        'checkout' => [
            'time-slots' => 'משבצות זמן אספקה',
            'seller'     => 'מוֹכֵר',
            'time'       => 'זְמַן',
            'date-day'   => 'תאריך יום',
            'admin'      => 'מנהל',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'משבצת זמן אספקה',
            'default-delivery-time'     => 'חריצי זמן אספקה ברירת מחדל',
            'save-btn'                  => 'שמור את התצורה',
            'delivery_date'             => 'תַאֲרִיך',
            'select-day'                => 'בחר יום',
            'start-time'                => 'שעת התחלה',
            'end-time'                  => 'זמן סיום',
            'quotas'                    => 'מכסות',
            'delivery-orders'           => 'הזמנות משלוח',
            'delivery-time-slots'       => 'משבצות זמן אספקה',
            'admin-delivery-time-slots' => 'חריצי זמן אספקה',
            'delivery-slots'            => 'משבצות משלוח',
            'status'                    => 'סטָטוּס',  
            'delete-confirm'            => 'האם אתה בטוח שאתה רוצה למחוק את המשבצת הזו?',
            'true'                      => 'נָכוֹן',
            'false'                     => 'שֶׁקֶר',
            'greater-than'              => 'גדול מ',
            'less-than'                 => 'פחות מ',
            'delivery-date-error'       => "תאריך ויום לא תואמים",
            'delivery-date-day'         => "תאריך משלוח/יום",
            'delivery-time'             => "זמן משלוח",

            'minimum-required-time' => [
               'title' => 'ימי מינימום הנדרשים לעיבוד סדר:',
               'info'  => 'הזן את מספר הימים, למשל: 5',
            ],

            'btn' => [
                'delete'        => 'לִמְחוֹק',
                'add-time-slot' => 'הוסף חריץ זמן',
            ],

            'days' => [
                'monday'    => 'יוֹם שֵׁנִי',
                'tuesday'   => 'יוֹם שְׁלִישִׁי',
                'wednesday' => 'יום רביעי',
                'thursday'  => 'יוֹם חֲמִישִׁי',
                'friday'    => 'יוֹם שִׁישִׁי',
                'saturday'  => 'יום שבת',
                'sunday'    => 'יוֹם רִאשׁוֹן',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'שם המוכר',
            'delivery-date'       => 'תאריך משלוח',
            'order'               => 'להזמין#',
            'delivery-time-from'  => 'זמן אספקה מ',
            'delivery-time-to'    => 'זמן אספקה ל',
            'delivery-orders'     => 'הזמנות משלוח',
            'delivery-time-slots' => 'משבצות זמן אספקה',
            'end-time'            => 'זמן סיום',
            'start-time'          => 'שעת התחלה',
            'allowed-orders'      => 'מותר להזמנות',
            'delivery-day'        => 'יום המשלוח',
            'action'              => 'פעולות',
            'order-id'            => 'מספר הזמנה',
            'customer-name'       => 'שם לקוח',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'הגדרת זמן אספקה',
                'info'  => 'חריץ זמן משלוח מאפשר ללקוחות לבחור את משבצות הזמן המועדפות עליהן
                    משלוח או שירותים בהתבסס על זמינותם או נוחותם.',
            ],

            'enable'                => 'לְאַפשֵׁר',
            'allowed-days'          => 'ימים מותרת',
            'display-total-days'    => 'להציג את הימים הכוללים',
            'dispaly-time-format'   => 'תצוגה של פורמט זמן',
            'minimun-time'          => 'זמן נדרש מינימלי בתהליך הסדרs',
            'error-message'         => 'הודעת שגיאה אם חריצי זמן אינם זמינים.',
            'success-message'       => ':שם נשמר בהצלחה.',

            'setting' => [
                'title' => 'הגדרות',
                'info'  => 'הגדר אפשרויות והודעות שגיאה.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'משבצת זמן אספקה',
                'info'  =>  'משבצת זמן אספקה.',
            ],
        ],
    ],
];