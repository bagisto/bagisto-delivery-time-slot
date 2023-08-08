<?php

return [
    'shop' => [
        'tracking-number' => 'Volg nummer',
        'layouts' => [
            'delivery-time-slot' => 'Bezorgtijdslot',
            'delivery-time-configuration' => 'Configuratie van tijdlevering',
            'save-btn' => 'Redden'
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Tijdslots',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'Configuratie van tijdslots',
            'delivery-order-history' => 'Geschiedenis van leveringsorders',
            'minimum-required-time' => 'Minimaal vereiste tijd in bestelproces:',
            'time-delivery-order' => 'Bestellingen voor tijdslevering',

            'datagrid' => [
                'delivery-date' => 'Bezorgdatum',
                'orders' => 'Volgorde#',
                'selected-slot' => 'Geselecteerde gokkast',
                'purchased-on' => 'Gekocht op',
            ],
        ],

        'checkout' => [
            'time-slots' => 'Tijdslots',
            'seller' => 'Verkoper',
            'time' => 'Tijd',
            'date-day' => 'Datum/Dag',
            'admin' => 'beheerder',

            'cart' => [
                'message' => 'Tijdvakken voor bezorging zijn niet beschikbaar voor dit product.'
            ]
        ],
    ],

    'admin' => [
        'layouts' => [
            'delivery-time-slot' => 'Bezorgtijdslot',
            'default-delivery-time' => 'Standaard levertijden',
            'save-btn' => 'Bewaar configuratie',
            'select-day' => 'Selecteer Dag',
            'start-time' => 'Starttijd',
            'end-time' => 'Eindtijd',
            'quotas' => 'quota',
            'delivery-orders' => 'Bezorg bestellingen',
            'delivery-time-slots' => 'Levertijd slots',
            'admin-delivery-time-slots' => 'Bezorgtijdslots voor beheerders',
            'delivery-slots' => 'Leveringsslots',
            'delete-confirm' => 'Weet je zeker dat je deze sleuf wilt verwijderen?',
            'start-time-error' => 'De starttijd moet verschillend zijn voor dezelfde bezorgdag.',

            'btn' => [
                'delete' => 'Delete',
                'add-time-slot' => 'Tijdslot toevoegen',
            ],

            'days' => [
                'monday' => 'Maandag',
                'tuesday' => 'Dinsdag',
                'wednesday' => 'Woensdag',
                'thursday' => 'Donderdag',
                'friday' => 'Vrijdag',
                'saturday' => 'Zaterdag',
                'sunday' => 'Zondag',
            ],
        ],

        'datagrid' => [
            'seller-name' => 'Naam van de verkoper',
            'delivery-date' => 'Bezorgdatum',
            'order' => 'Volgorde#',
            'delivery-time-from' => 'Levertijd vanaf',
            'delivery-time-to' => 'Levertijd tot',
            'delivery-orders' => 'Bezorg bestellingen',
            'delivery-time-slots' => 'Levertijd slots',
            'end-time' => 'Eindtijd',
            'start-time' => 'Starttijd',
            'allowed-orders' => 'Toegestane bestellingen',
            'delivery-day' => 'Dag van bezorging',
            'action' => 'Acties',
            'order-id' => 'Order ID',
            'customer-name' => 'klantnaam'
        ],

        'system' => [
            'delivery-time-setting' => 'Instelling bezorgtijd',
            'enable' => 'Inschakelen',
            'allowed-days' => 'Toegestane dagen',
            'display-total-days' => 'Totaal aantal dagen weergeven',
            'display-time-format' => 'Tijdformaat weergeven',
            'minimun-time' => 'Minimaal benodigde tijd in bestelproces',
            'error-message' => 'Foutmelding als tijdslots niet beschikbaar zijn.',
            'success-message' => ':name Met succes opgeslagen.',
            'setting' => 'Instellingen',
            'delivery-time-slot' => 'Bezorgtijdslot',
            'show-message' => 'Toon foutmelding in de winkel als slots niet beschikbaar zijn.'
        ],
    ],
];