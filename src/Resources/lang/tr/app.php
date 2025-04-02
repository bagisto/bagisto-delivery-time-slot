<?php

return [
    'shop' => [
        'tracking-number' => 'Takip numarası',

        'delivery-time-slot' => [
            'title'                       => 'Teslimat Süresi Yuvası',
            'delivery-time-configuration' => 'Zaman Teslimat Yapılandırması',
            'save-btn'                    => 'Kaydetmek',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Zaman dilimleri',
            ],
        ],
        
        'checkout' => [
            'time-slots' => 'Teslimat Süre Yuvaları',
            'seller'     => 'Satıcı',
            'time'       => 'Zaman',
            'date-day'   => 'Randevu günü',
            'admin'      => 'Yönetici',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Teslimat Süresi Yuvası',
            'default-delivery-time'     => 'Varsayılan Teslimat Süre Yüzleri',
            'save-btn'                  => 'Yapılandırmayı Kaydet',
            'delivery_date'             => 'Tarih',
            'select-day'                => 'Seçim Günü',
            'start-time'                => 'Başlangıç ​​saati',
            'end-time'                  => 'Bitiş zamanı',
            'quotas'                    => 'Kotalar',
            'delivery-orders'           => 'Teslimat Siparişleri',
            'delivery-time-slots'       => 'Teslimat Süre Yuvaları',
            'admin-delivery-time-slots' => 'Yönetici Teslimat Süre Yüzleri',
            'delivery-slots'            => 'Teslimat Yuvaları',
            'status'                    => 'Durum',  
            'delete-confirm'            => 'Bu yuvayı silmek istediğinden emin misiniz?',
            'true'                      => 'Doğru',
            'false'                     => 'YANLIŞ',
            'greater-than'              => 'Daha büyük',
            'less-than'                 => 'Daha az',
            'delivery-date-error'       => "Tarih ve gün eşleşmiyor",
            'delivery-date-day'         => "Teslimat Tarihi/Gün",
            'delivery-time'             => "Teslimat süresi",

            'minimum-required-time' => [
               'title' => 'Sıra işlemesi için gereken minimum gün:',
               'info'  =>  'Gün sayısını girin, ör: 5 ',
            ],

            'btn' => [
                'delete'        => 'Silmek',
                'add-time-slot' => 'Zaman dilimi ekle',
            ],

            'days' => [
                'monday'    => 'Pazartesi',
                'tuesday'   => 'Salı',
                'wednesday' => 'Çarşamba',
                'thursday'  => 'Perşembe',
                'friday'    => 'Cuma',
                'saturday'  => 'Cumartesi',
                'sunday'    => 'Pazar',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Satıcı Adı',
            'delivery-date'       => 'Teslim tarihi',
            'order'               => 'Emir#',
            'delivery-time-from'  => '',
            'delivery-time-to'    => 'Teslimat Süresi',
            'delivery-orders'     => 'Teslimat Siparişleri',
            'delivery-time-slots' => 'Teslimat Süre Yüzleri',
            'end-time'            => 'Bitiş zamanı',
            'start-time'          => 'Başlangıç ​​saati',
            'allowed-orders'      => 'İzin verilen siparişler',
            'delivery-day'        => 'Teslim günü',
            'action'              => 'Hareketler',
            'order-id'            => 'Sipariş Kimliği',
            'customer-name'       => 'müşteri adı',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Teslimat Süresi Ayarı',
                'info'  => 'Teslimat süresi yuvası, müşterilerin tercih ettikleri zaman aralıklarını seçmelerine olanak tanır
                    Müsaitlik veya rahatlıklarına göre teslimat veya hizmetler.',
            ],

            'enable'                => 'Olanak vermek',
            'allowed-days'          => 'İzin verilen günler ',
            'display-total-days'    => 'Toplam günleri göster',
            'dispaly-time-format'   => 'Ekran Süresi Biçimi',
            'minimun-time'          => 'Sırada gerekli minimum zaman',
            'error-message'         => 'Zaman aralıkları mevcut değilse hata mesajı.',
            'success-message'       => ': İsim başarıyla kaydedildi.',

            'setting' => [
                'title' => 'Ayarlar',
                'info'  => 'Seçenekleri ve hata mesajlarını ayarlayın.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Teslimat Süresi Yuvası',
                'info'  =>  'Teslimat Süresi Yuvası.',
            ],
        ],
    ],
];