<?php

return [
   'shop' => [
       'tracking-number' => 'Takip Numarası',

       'delivery-time-slot' => [
          'title'                       => 'Teslimat Zaman Aralığı',
          'delivery-time-configuration' => 'Zaman Teslimatı Yapılandırması',
          'save-btn'                    => 'Kaydet',
       ],

       'email' => [
          'customer' => [
             'time-slots' => 'Zaman Aralıkları',
            ],
        ],
    
       'checkout' => [
         'time-slots' => 'Teslimat Zaman Aralıkları',
          'seller'     => 'Satıcı',
          'time'       => 'Zaman',
          'date-day'   => 'Tarih/Gün',
          'admin'      => 'Yönetici',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Teslimat Zaman Aralığı',
            'default-delivery-time'     => 'Varsayılan Teslimat Zaman Aralıkları',
            'save-btn'                  => 'Yapılandırmayı Kaydet',
            'delivery_date'             => 'Tarih',
            'select-day'                => 'Gün Seç',
            'start-time'                => 'Başlangıç Zamanı',
            'end-time'                  => 'Bitiş Zamanı',
            'quotas'                    => 'Kotalar',
            'delivery-orders'           => 'Teslimat Siparişleri',
            'delivery-time-slots'       => 'Teslimat Zaman Aralıkları',
            'admin-delivery-time-slots' => 'Yönetici Teslimat Zaman Aralıkları',
            'delivery-slots'            => 'Teslimat Aralıkları',
            'status'                    => 'Durum',  
            'delete-confirm'            => 'Bu aralığı silmek istediğinizden emin misiniz?',
            'true'                      => 'Doğru',
            'false'                     => 'Yanlış',
            'greater-than'              => 'Büyük',
            'less-than'                 => 'Küçük',
            'delivery-date-error'       => 'Tarih ve gün eşleşmiyor',
            'delivery-date-day'         => 'Teslimat Tarihi/Günü',
            'delivery-time'             => 'Teslimat Zamanı',
    
            'minimum-required-time' => [
               'title' => 'Sipariş İşleme İçin Minimum Gün Sayısı:',
               'info'  =>  'Gün sayısını girin, örn: 5',
            ],
    
            'btn' => [
                'delete'        => 'Sil',
                'add-time-slot' => 'Zaman Aralığı Ekle',
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
            'delivery-date'       => 'Teslimat Tarihi',
            'order'               => 'Sipariş#',
            'delivery-time-from'  => 'Teslimat Zamanı - Başlangıç',
            'delivery-time-to'    => 'Teslimat Zamanı - Bitiş',
            'delivery-orders'     => 'Teslimat Siparişleri',
            'delivery-time-slots' => 'Teslimat Zaman Aralıkları',
            'end-time'            => 'Bitiş Zamanı',
            'start-time'          => 'Başlangıç Zamanı',
            'allowed-orders'      => 'İzin Verilen Siparişler',
            'delivery-day'        => 'Teslimat Günü',
            'action'              => 'İşlemler',
            'order-id'            => 'Sipariş ID',
            'customer-name'       => 'Müşteri Adı',
        ],
    
        'system' => [
            'delivery-time-setting' => [
                'title' => 'Teslimat Zamanı Ayarı',
                'info'  => 'Teslimat Zaman Aralığı, müşterilerin uygunluklarına veya kolaylıklarına göre tercih ettikleri zaman aralıklarını seçmelerine olanak tanır.',
            ],
    
            'enable'                => 'Etkinleştir',
            'allowed-days'          => 'İzin Verilen Günler',
            'display-total-days'    => 'Toplam Günleri Göster',
            'dispaly-time-format'   => 'Zaman Formatını Göster',
            'minimun-time'          => 'Sipariş İşlemi İçin Minimum Gerekli Süre',
            'error-message'         => 'Zaman Aralıkları Mevcut Değilse Hata Mesajı.',
            'success-message'       => ':name Başarıyla Kaydedildi.',
    
            'setting' => [
                'title' => 'Ayarlar',
                'info'  => 'Seçenekleri ve hata mesajlarını ayarlayın.',
            ],
    
            'delivery-time-slot' =>  [
                'title' => 'Teslimat Zaman Aralığı',
                'info'  =>  'Teslimat Zaman Aralığı.',
            ],
        ],
    ],
];