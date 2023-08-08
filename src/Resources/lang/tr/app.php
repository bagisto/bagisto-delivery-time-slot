<?php

return [
    'shop' => [
        'tracking-number' => 'Takip numarası',
        'layouts' => [
            'delivery-time-slot' => 'Teslim Süresi Yuvası',
            'delivery-time-configuration' => 'Zamanında Teslimat Yapılandırması',
            'save-btn' => 'Kaydetmek'
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Zaman dilimleri',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'Zaman Yuvaları Yapılandırması',
            'delivery-order-history' => 'Teslimat Siparişi Geçmişi',
            'minimum-required-time' => 'Sipariş Sürecinde Gerekli Minimum Süre:',
            'time-delivery-order' => 'Zamanında Teslimat Siparişleri',

            'datagrid' => [
                'delivery-date' => 'Teslim tarihi',
                'orders' => 'Emir#',
                'selected-slot' => 'Seçilen Yuva',
                'purchased-on' => 'Tarihinde satın alındı',
            ],
        ],

        'checkout' => [
            'time-slots' => 'Zaman dilimleri',
            'seller' => 'satıcı',
            'time' => 'Zaman',
            'date-day' => 'Randevu günü',
            'admin' => 'yönetici',

            'cart' => [
                'message' => 'Bu ürün için teslimat zaman aralıkları mevcut değil.'
            ]
        ],
    ],

    'admin' => [
        'layouts' => [
            'delivery-time-slot' => 'Teslim Süresi Yuvası',
            'default-delivery-time' => 'Varsayılan Teslim Süresi Aralıkları',
            'save-btn' => 'Yapılandırmayı Kaydet',
            'select-day' => 'Gün Seç',
            'start-time' => 'Başlangıç ​​saati',
            'end-time' => 'Bitiş zamanı',
            'quotas' => 'kotalar',
            'delivery-orders' => 'Teslimat Siparişleri',
            'delivery-time-slots' => 'Teslim Süresi Aralıkları',
            'admin-delivery-time-slots' => 'Yönetici Teslim Süresi Aralıkları',
            'delivery-slots' => 'Teslimat Yuvaları',
            'delete-confirm' => 'Bu yuvası silmek istediğinizden emin misiniz?',
            'start-time-error' => 'Aynı teslim günü için başlangıç ​​saati farklı olmalıdır.',

            'btn' => [
                'delete' => 'Silmek',
                'add-time-slot' => 'Zaman Aralığı Ekle',
            ],

            'days' => [
                'monday' => 'Pazartesi',
                'tuesday' => 'Salı',
                'wednesday' => 'Çarşamba',
                'thursday' => 'Perşembe',
                'friday' => 'Cuma',
                'saturday' => 'Cumartesi',
                'sunday' => 'Pazar',
            ],
        ],

        'datagrid' => [
            'seller-name' => 'Satıcı Adı',
            'delivery-date' => 'Teslim tarihi',
            'order' => 'Emir#',
            'delivery-time-from' => 'Teslim Süresi',
            'delivery-time-to' => 'Teslim Süresi',
            'delivery-orders' => 'Teslimat Siparişleri',
            'delivery-time-slots' => 'Teslim Süresi Aralıkları',
            'end-time' => 'Bitiş zamanı',
            'start-time' => 'Başlangıç ​​saati',
            'allowed-orders' => 'İzin Verilen Siparişler',
            'delivery-day' => 'Teslim günü',
            'action' => 'Hareketler',
            'order-id' => 'Sipariş Kimliği',
            'customer-name' => 'müşteri adı'
        ],

        'system' => [
            'delivery-time-setting' => 'Teslim Süresi Ayarı',
            'enable' => 'Olanak vermek',
            'allowed-days' => 'İzin Verilen Günler',
            'display-total-days' => 'Toplam Günleri Görüntüle',
            'display-time-format' => 'Görüntüleme Saati Formatı',
            'minimun-time' => 'Sipariş Sürecinde Gerekli Minimum Süre',
            'error-message' => 'Zaman Yuvaları yoksa Hata Mesajı.',
            'success-message' => ':name Başarıyla kaydedildi.',
            'setting' => 'Ayarlar',
            'delivery-time-slot' => 'Teslim Süresi Yuvası',
            'show-message' => 'Yuva yoksa mağazada hata mesajı göster.'
        ],
    ],
];