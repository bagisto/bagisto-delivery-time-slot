<?php

return [
    'shop' => [
        'tracking-number' => 'Идентификационный номер',

        'delivery-time-slot' => [
            'title'                       => 'Слот времени доставки',
            'delivery-time-configuration' => 'Конфигурация доставки времени',
            'save-btn'                    => 'Сохранять',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Временные интервалы',
            ],
        ],
        
        'checkout' => [
            'time-slots' => 'Время доставки слоты',
            'seller'     => 'Продавец',
            'time'       => 'Время',
            'date-day'   => 'Дата/день',
            'admin'      => 'Администратор',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Слот времени доставки',
            'default-delivery-time'     => 'Слоты времени доставки по умолчанию',
            'save-btn'                  => 'Сохранить конфигурацию',
            'delivery_date'             => 'Дата',
            'select-day'                => 'Выберите день',
            'start-time'                => 'Время начала',
            'end-time'                  => 'Время окончания',
            'quotas'                    => 'Квоты',
            'delivery-orders'           => 'Заказы на доставку',
            'delivery-time-slots'       => 'Время доставки слоты',
            'admin-delivery-time-slots' => "Слоты времени доставки администратора",
            'delivery-slots'            => 'Слоты доставки',
            'status'                    => 'Положение дел',  
            'delete-confirm'            => 'Вы уверены, что хотите удалить этот слот?',
            'true'                      => 'Истинный',
            'false'                     => 'ЛОЖЬ',
            'greater-than'              => 'Больше чем',
            'less-than'                 => 'Меньше, чем',
            'delivery-date-error'       => "Дата и день не совпадают",
            'delivery-date-day'         => "Дата доставки/день",
            'delivery-time'             => "Срок поставки",

            'minimum-required-time' => [
               'title' => 'Минимальные дни, необходимые для обработки порядка:',
               'info'  => 'Введите количество дней, например: 5',
            ],

            'btn' => [
                'delete'        => 'Удалить',
                'add-time-slot' => 'Добавить временной интервал',
            ],

            'days' => [
                'monday'    => 'Понедельник',
                'tuesday'   => 'Вторник',
                'wednesday' => 'Среда',
                'thursday'  => 'Четверг',
                'friday'    => 'Пятница',
                'saturday'  => 'Суббота',
                'sunday'    => 'Воскресенье',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Название продавца',
            'delivery-date'       => 'Дата доставки',
            'order'               => 'Заказ#',
            'delivery-time-from'  => 'Время доставки от',
            'delivery-time-to'    => 'Время доставки',
            'delivery-orders'     => 'Заказы на доставку',
            'delivery-time-slots' => 'Время доставки слоты',
            'end-time'            => 'Время окончания',
            'start-time'          => 'Время начала',
            'allowed-orders'      => 'Разрешенные заказы',
            'delivery-day'        => 'День доставки',
            'action'              => 'Действия',
            'order-id'            => 'Номер заказа',
            'customer-name'       => 'Имя Клиента',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Настройка времени доставки',
                'info'  => 'Срок подачи времени позволяет клиентам выбирать предпочтительные временные интервалы для
                    доставка или услуги в зависимости от их доступности или удобства.',
            ],

            'enable'                => 'Давать возможность',
            'allowed-days'          => 'Разрешенные дни',
            'display-total-days'    => 'Показывать общие дни ',
            'dispaly-time-format'   => 'Отображение формата времени',
            'minimun-time'          => 'Минимальное необходимое время в процессе порядка ',
            'error-message'         => 'Сообщение об ошибке, если временные слоты недоступны.',
            'success-message'       => ': Имя успешно сохранилось.',

            'setting' => [
                'title' => 'Настройки',
                'info'  => 'Установить параметры и сообщения об ошибках.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Слот времени доставки',
                'info'  => 'Слот времени доставки.',
            ],
        ],
    ],
];