<?php

return [
    'shop' => [
        'tracking-number' => 'Volg nummer',

        'delivery-time-slot' => [
            'title'                       => 'Levertijdslot',
            'delivery-time-configuration' => 'Tijdafleveringsconfiguratie',
            'save-btn'                    => 'Redden',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Tijdslots',
            ],
        ],
        
        'checkout' => [
            'time-slots' => 'Levertijd slots',
            'seller'     => 'Verkoper',
            'time'       => 'Tijd',
            'date-day'   => 'Datum/dag',
            'admin'      => 'beheerder',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Levertijdslot',
            'default-delivery-time'     => 'Standaard leveringstijd slots',
            'save-btn'                  => 'Bewaar configuratie',
            'delivery_date'             => 'Datum',
            'select-day'                => 'Selecteer dag ',
            'start-time'                => 'Starttijd',
            'end-time'                  => 'Eindtijd',
            'quotas'                    => 'Quota',
            'delivery-orders'           => 'Leveringsopdrachten',
            'delivery-time-slots'       => 'Levertijd slots',
            'admin-delivery-time-slots' => 'Admin Levers Time Slots',
            'delivery-slots'            => 'Leveringslots',
            'status'                    => 'Toestand',  
            'delete-confirm'            => 'Weet u zeker dat u deze slot wilt verwijderen?',
            'true'                      => 'WAAR',
            'false'                     => 'Vals',
            'greater-than'              => 'Groter dan',
            'less-than'                 => 'Minder dan',
            'delivery-date-error'       => "Datum en dag komen niet overeen",
            'delivery-date-day'         => "Leverdatum/dag",
            'delivery-time'             => "Aflevertijd",

            'minimum-required-time' => [
               'title' => 'Minimale dagen vereist bij het verwerken van de volgorde:',
               'info'  => 'Voer het aantal dagen in, bijvoorbeeld: 5',
            ],

            'btn' => [
                'delete'        => 'Verwijderen',
                'add-time-slot' => 'Tijdslot toevoegen',
            ],

            'days' => [
                'monday'    => 'Maandag',
                'tuesday'   => 'Dinsdag',
                'wednesday' => 'Woensdag',
                'thursday'  => 'Donderdag',
                'friday'    => 'Vrijdag',
                'saturday'  => 'Zaterdag',
                'sunday'    => 'Zondag',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Naam van de verkoper',
            'delivery-date'       => 'Bezorgdatum',
            'order'               => 'Volgorde#',
            'delivery-time-from'  => 'Levertijd van',
            'delivery-time-to'    => 'Levertijd naar',
            'delivery-orders'     => 'Leveringsopdrachten',
            'delivery-time-slots' => 'Levertijd slots',
            'end-time'            => 'Eindtijd',
            'start-time'          => 'Starttijd',
            'allowed-orders'      => 'Toegestane bestellingen',
            'delivery-day'        => 'Leverdag',
            'action'              => 'Acties',
            'order-id'            => 'orderId',
            'customer-name'       => 'klantnaam',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Levertijdinstellingng',
                'info'  => 'Leveringstijd-slot stelt klanten in staat om hun voorkeurstijdslots te selecteren voor
                    Levering of diensten op basis van hun beschikbaarheid of gemak.',
            ],

            'enable'                => 'Inschakelen',
            'allowed-days'          => 'Toegestane dagen',
            'display-total-days'    => 'Toon totale dagen',
            'dispaly-time-format'   => 'Deelt de tijdsformaat weer',
            'minimun-time'          => 'Minimaal vereiste tijd in bestellingsproces',
            'error-message'         => 'Foutbericht als tijdslots niet beschikbaar zijn.',
            'success-message'       => ': naam met succes opgeslagen.',

            'setting' => [
                'title' => 'Instellingen',
                'info'  => 'Stel opties en foutmeldingen in.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Levertijdslot',
                'info'  => 'Levertijdslot.',
            ],
        ],
    ],
];