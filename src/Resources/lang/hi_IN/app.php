<?php

return [
    'shop' => [
        'tracking-number' => 'ट्रैकिंग नंबर',
        'delivery-time-slot'         => [
            'title'                       => 'वितरण समय स्लॉट',
            'delivery-time-configuration' => 'समय वितरण विन्यास',
            'save-btn'                    => 'बचाना',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'समय स्थान',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'समय स्लॉट कॉन्फ़िगरेशन',
            'delivery-order-history'  => 'वितरण आदेश इतिहास',
            'minimum-required-time'   => 'क्रम प्रक्रिया में न्यूनतम आवश्यक समय:',
            'time-delivery-order'     => 'समय वितरण आदेश',
            'datagrid'                => [
                'delivery-date' => 'डिलीवरी की तारीख',
                'orders'        => 'आदेश देना#',
                'selected-slot' => 'चयनित स्लॉट',
                'purchased-on'  => 'पर खरीदा गया',
            ],
        ],

        'checkout' => [
            'time-slots' => 'वितरण समय स्लॉट',
            'seller'     => 'विक्रेता',
            'time'       => 'समय',
            'date-day'   => 'तिथि दिन',
            'admin'      => 'व्यवस्थापक',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'वितरण समय स्लॉट',
            'default-delivery-time'     => 'डिफ़ॉल्ट वितरण समय स्लॉट',
            'save-btn'                  => 'कॉन्फ़िगर सहेजें',
            'delivery_date'             => 'तारीख',
            'select-day'                => 'दिन का चयन करें ',
            'start-time'                => 'समय शुरू',
            'end-time'                  => 'अंत समय',
            'quotas'                    => 'कोटा',
            'delivery-orders'           => 'वितरण आदेश',
            'delivery-time-slots'       => 'वितरण समय स्लॉट',
            'admin-delivery-time-slots' => 'व्यवस्थापक वितरण समय स्लॉट',
            'delivery-slots'            => 'वितरण स्लॉट',
            'status'                    => 'स्थिति',  
            'delete-confirm'            => 'क्या आप सुनिश्चित हैं कि आप इस स्लॉट को हटाना चाहते हैं?',
            'true'                      => 'सत्य',
            'false'                     => 'असत्य',
            'greater-than'              => 'से अधिक',
            'less-than'                 => 'से कम',
            'delivery-date-error'       => "तारीख और दिन मेल नहीं खाता",
            'delivery-date-day'         => "डिलीवरी की तारीख/दिन",
            'delivery-time'             => "डिलीवरी का समय",

            'minimum-required-time'     => [
               'title' => 'आदेश प्रसंस्करण में आवश्यक न्यूनतम दिन:',
               'info' => 'दिन की संख्या दर्ज करें, उदा: 5',
            ],

            'btn'                       => [
                 'delete'       => 'मिटाना',
                'add-time-slot' => 'टाइम स्लॉट जोड़ें',
            ],

            'days'                       => [
                'monday'    => 'सोमवार',
                'tuesday'   => 'मंगलवार',
                'wednesday' => 'बुधवार',
                'thursday'  => 'गुरुवार',
                'friday'    => 'शुक्रवार',
                'saturday'  => 'शनिवार',
                'sunday'    => 'रविवार',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'विक्रेता का नाम',
            'delivery-date'       => 'डिलीवरी की तारीख',
            'order'               => 'आदेश देना',
            'delivery-time-from'  => 'से डिलीवरी का समय',
            'delivery-time-to'    => 'डिलीवरी का समय',
            'delivery-orders'     => 'वितरण आदेश',
            'delivery-time-slots' => 'वितरण समय स्लॉट',
            'end-time'            => 'अंत समय',
            'start-time'          => 'समय शुरू',
            'allowed-orders'      => 'अनुमत आदेश',
            'delivery-day'        => 'डिलिवरी का दिन',
            'action'              => 'कार्रवाई',
            'order-id'            => 'आदेश कामतत्व',
            'customer-name'       => 'ग्राहक का नाम',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'वितरण समय की स्थापना',
                'info'  => 'डिलीवरी टाइम-स्लॉट ग्राहकों को अपने पसंदीदा समय स्लॉट का चयन करने की अनुमति देता है
                    उनकी उपलब्धता या सुविधा के आधार पर वितरण या सेवाएं।',
            ],
            'enable'                => 'सक्षम',
            'allowed-days'          => 'अनुमत दिन',
            'display-total-days'    => 'कुल दिन प्रदर्शित करें',
            'dispaly-time-format'   => 'प्रदर्शन समय प्रारूप',
            'minimun-time'          => 'क्रम प्रक्रिया में न्यूनतम आवश्यक समय',
            'error-message'         => 'त्रुटि संदेश यदि समय स्लॉट उपलब्ध नहीं है।',
            'success-message'       => ': नाम सफलतापूर्वक बच गया।',
            'setting'               => [
                'title' => 'समायोजन',
                'info'  => 'विकल्प और त्रुटि संदेश सेट करें।',
            ],
            'delivery-time-slot'    =>  [
                'title' => 'वितरण समय स्लॉट',
                'info'  => 'वितरण समय स्लॉट.',
            ],
        ],
    ],
];