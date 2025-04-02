<?php

return [
    'shop' => [
        'tracking-number' => 'Numer przesyłki',

        'delivery-time-slot' => [
            'title'                       => 'Dostawa czasowa',
            'delivery-time-configuration' => 'Konfiguracja dostawy czasu',
            'save-btn'                    => 'Ratować',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Przedziały czasowe',
            ],
        ],
        
        'checkout' => [
            'time-slots' => 'Sloty czasowe dostawy',
            'seller'     => 'Sprzedawca',
            'time'       => 'Czas',
            'date-day'   => 'Data dnia',
            'admin'      => 'admin',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Dostawa czasowa',
            'default-delivery-time'     => 'Domyślne przedziały czasowe dostawy',
            'save-btn'                  => 'Zapisz konfigurację',
            'delivery_date'             => 'Data',
            'select-day'                => 'Wybierz dzień',
            'start-time'                => 'Czas rozpoczęcia',
            'end-time'                  => 'Koniec czasu',
            'quotas'                    => 'Kwoty',
            'delivery-orders'           => 'Zamówienia dostawy',
            'delivery-time-slots'       => 'Sloty czasowe dostawy',
            'admin-delivery-time-slots' => 'Sloty czasowe dostawy administratora',
            'delivery-slots'            => 'Sloty dostawy',
            'status'                    => 'status',  
            'delete-confirm'            => 'Czy na pewno chcesz usunąć to miejsce?',
            'true'                      => 'PRAWDA',
            'false'                     => 'FAŁSZ',
            'greater-than'              => 'Lepszy niż',
            'less-than'                 => 'Mniej niż',
            'delivery-date-error'       => "Data i dzień nie pasuje",
            'delivery-date-day'         => "Data dostawy/dzień",
            'delivery-time'             => "Czas dostawy",

            'minimum-required-time' => [
               'title' => 'Minimalne dni wymagane w kolejności przetwarzania:',
               'info'  =>  'Wprowadź liczbę dni, np. 5',
            ],

            'btn' => [
                'delete'        => 'Usuwać',
                'add-time-slot' => 'Dodaj przedział czasowy',
            ],

            'days' => [
                'monday'    => 'Poniedziałek',
                'tuesday'   => 'Wtorek',
                'wednesday' => 'Środa',
                'thursday'  => 'Czwartek',
                'friday'    => 'Piątek',
                'saturday'  => 'Sobota',
                'sunday'    => 'Niedziela',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Nazwa sprzedawcy',
            'delivery-date'       => 'Data dostarczenia',
            'order'               => 'Zamówienie#',
            'delivery-time-from'  => 'Czas dostawy z',
            'delivery-time-to'    => 'Czas dostawy do',
            'delivery-orders'     => 'Zamówienia dostaw',
            'delivery-time-slots' => 'Sloty czasowe dostawy',
            'end-time'            => 'Koniec czasu',
            'start-time'          => 'Czas rozpoczęcia',
            'allowed-orders'      => 'Dozwolone zamówienia',
            'delivery-day'        => 'Dzień dostawy',
            'action'              => 'działania',
            'order-id'            => 'Zamów id',
            'customer-name'       => 'Nazwa klienta',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Ustawienie czasu dostawy',
                'info'  => 'Lot czasowy pozwala klientom wybrać preferowane przedziały czasowe dla
                    dostawa lub usługi w oparciu o ich dostępność lub wygodę.',
            ],

            'enable'                => 'Włączać',
            'allowed-days'          => 'Dozwolony dzieńs',
            'display-total-days'    => 'Wyświetl łącznie dni',
            'dispaly-time-format'   => 'Format czasu wyświetlania',
            'minimun-time'          => 'Minimalny wymagany czas w kolejności',
            'error-message'         => 'Komunikat o błędzie Jeśli szczeliny czasowe niedostępne.',
            'success-message'       => ': Nazwa zapisana pomyślnie.',

            'setting' => [
                'title' => 'Ustawienia',
                'info'  => 'Ustaw opcje i komunikaty o błędach.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Dostawa czasowa',
                'info'  => 'Dostawa czasowa.',
            ],
        ],
    ],
];