<?php

return [
    'shop' => [
        'tracking-number' => 'Numero di identificazione',

        'delivery-time-slot' => [
            'title'                       => 'Slot orario di consegna',
            'delivery-time-configuration' => 'Configurazione di consegna del tempo',
            'save-btn'                    => 'Salva',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Fasce orarie',
            ],
        ],
        
        'checkout' => [
            'time-slots' => 'Feste orali di consegna',
            'seller'     => 'Venditrice',
            'time'       => 'Tempo',
            'date-day'   => 'Data/giorno',
            'admin'      => 'Amministratrice',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Slot orario di consegna',
            'default-delivery-time'     => 'Slot temporale di consegna predefinitos',
            'save-btn'                  => 'Salva configurazione',
            'delivery_date'             => 'Data',
            'select-day'                => 'Seleziona il giorno',
            'start-time'                => 'Ora di inizio',
            'end-time'                  => 'Tempo scaduto',
            'quotas'                    => 'Quote',
            'delivery-orders'           => 'Ordini di consegna',
            'delivery-time-slots'       => 'Feste orali di consegna',
            'admin-delivery-time-slots' => 'Slot di tempo di consegna amministratore',
            'delivery-slots'            => 'Slot di consegna ',
            'status'                    => 'Stato',  
            'delete-confirm'            => 'Sei sicuro di voler eliminare questo slot?',
            'true'                      => 'Vera',
            'false'                     => 'Falso',
            'greater-than'              => 'Più grande di',
            'less-than'                 => 'Meno di',
            'delivery-date-error'       => "Data e giorno non corrispondono",
            'delivery-date-day'         => "Data di consegna/giorno",
            'delivery-time'             => "Tempi di consegna",

            'minimum-required-time' => [
               'title' => "Giorni minimi richiesti nell'elaborazione dell'ordine: ",
               'info'  => 'Immettere il numero di giorni, ad esempio: 5',
            ],

            'btn' => [
                'delete'        => 'Eliminare',
                'add-time-slot' => 'Aggiungi la fascia oraria',
            ],

            'days' => [
                'monday'    => 'Lunedi',
                'tuesday'   => 'Martedì',
                'wednesday' => 'Mercoledì',
                'thursday'  => 'Giovedì',
                'friday'    => 'Venerdì',
                'saturday'  => 'Sabato',
                'sunday'    => 'Domenica',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Nome venditore',
            'delivery-date'       => 'Data di consegna',
            'order'               => 'Ordine#',
            'delivery-time-from'  => 'Tempo di consegna da',
            'delivery-time-to'    => 'Tempo di consegna a',
            'delivery-orders'     => 'Ordini di consegna',
            'delivery-time-slots' => 'Feste orali di consegna',
            'end-time'            => 'Tempo scaduto',
            'start-time'          => 'Ora di inizio',
            'allowed-orders'      => 'Ordini consentiti',
            'delivery-day'        => 'Giorno di consegna',
            'action'              => 'Azioni',
            'order-id'            => 'ID ordine',
            'customer-name'       => 'Nome del cliente',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Impostazione dei tempi di consegna',
                'info'  => 'La slot temporale di consegna consente ai clienti di selezionare le loro fasce di tempo preferite per
                    consegna o servizi in base alla loro disponibilità o comodità.',
            ],

            'enable'                => 'Abilitare',
            'allowed-days'          => 'Giorni consentiti',
            'display-total-days'    => 'Visualizza i giorni totali',
            'dispaly-time-format'   => 'Visualizza il formato del tempo',
            'minimun-time'          => "Tempo minimo richiesto nel processo dell'ordine",
            'error-message'         => 'Messaggio di errore Se le fasce di tempo non sono disponibili.',
            'success-message'       => ': nome salvato con successo.',

            'setting' => [
                'title' => 'Impostazioni',
                'info'  => 'Imposta opzioni e messaggi di errore.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Slot orario di consegna',
                'info'  => 'Slot orario di consegna.',
            ],
        ],
    ],
];