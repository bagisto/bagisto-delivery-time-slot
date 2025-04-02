<?php

return [
    'shop' => [
        'tracking-number' => 'Tracking-Nummer',
        
        'delivery-time-slot' => [
            'title'                       => 'Lieferzeitschlitz',
            'delivery-time-configuration' => 'Zeitlieferungskonfiguration',
            'save-btn'                    => 'Speichern',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Zeitfenster',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'Zeitschlitzkonfigurationn',
            'delivery-order-history'  => 'Lieferauftragsverlauf',
            'minimum-required-time'   => 'Mindestzeit für den Auftragsprozess:',
            'time-delivery-order'     => 'Zeitlieferungsbestellungen',
            'datagrid'                => [
                'delivery-date' => 'Liefertermin',
                'orders'        => 'Befehl#',
                'selected-slot' => 'Ausgewählter Slot',
                'purchased-on'  => 'Gekauft auf',
            ],
        ],

        'checkout' => [
            'time-slots' => 'Lieferzeitfenster',
            'seller'     => 'Verkäuferin',
            'time'       => 'Zeit',
            'date-day'   => 'Datum/Tag',
            'admin'      => 'Administratorin',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Lieferzeitschlitz',
            'default-delivery-time'     => 'Standard -Lieferzeitfenster',
            'save-btn'                  => 'Konfiguration speichern',
            'delivery_date'             => 'Datum',
            'select-day'                => 'Tag auswählen',
            'start-time'                => 'Startzeit',
            'end-time'                  => 'Endzeit ',
            'quotas'                    => 'Quoten',
            'delivery-orders'           => 'Lieferaufträge',
            'delivery-time-slots'       => 'Lieferzeitfenster',
            'admin-delivery-time-slots' => 'Verwaltungszeitfensterts',
            'delivery-slots'            => 'Lieferplätze',
            'status'                    => 'status',  
            'delete-confirm'            => 'Sind Sie sicher, dass Sie diesen Slot löschen möchten?',
            'true'                      => 'WAHR',
            'false'                     => 'FALSCH',
            'greater-than'              => 'Größer als',
            'less-than'                 => 'Weniger als',
            'delivery-date-error'       => "Datum und Tag stimmen nicht überein",
            'delivery-date-day'         => "Lieferdatum/Tag",
            'delivery-time'             => "Lieferzeit",

            'minimum-required-time' => [
               'title' => 'Mindesttage erforderlich in der Reihenfolge Verarbeitung:',
               'info'  => 'Geben Sie die Anzahl der Tage ein, z. B. 5',
            ],

            'btn' => [
                'delete'        => 'Löschen',
                'add-time-slot' => 'Zeitfenster hinzufügen',
            ],

            'days'                       => [
                'monday'    => 'Montag',
                'tuesday'   => 'Dienstag',
                'wednesday' => 'Mittwoch',
                'thursday'  => 'Donnerstag',
                'friday'    => 'Freitag',
                'saturday'  => 'Samstag',
                'sunday'    => 'Sonntag',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Name des Verkäufers',
            'delivery-date'       => 'Liefertermin',
            'order'               => 'Befehl#',
            'delivery-time-from'  => 'Lieferzeit von',
            'delivery-time-to'    => 'Lieferzeit an',
            'delivery-orders'     => 'Lieferaufträge',
            'delivery-time-slots' => 'Lieferzeitschlitzs',
            'end-time'            => 'Endzeit',
            'start-time'          => 'Startzeit',
            'allowed-orders'      => 'Zugelassene Bestellungen',
            'delivery-day'        => "Liefertag",
            'action'              => 'Aktionen',
            'order-id'            => 'Auftragsnummer',
            'customer-name'       => 'Kundenname',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Lieferzeiteinstellung',
                'info'  => 'Die Lieferzeit des Lieferung ermöglicht es Kunden, ihre bevorzugten Zeitfenster für die Auswahl zu
                    Lieferung oder Dienstleistungen aufgrund ihrer Verfügbarkeit oder Bequemlichkeit.',
            ],

            'enable'              => 'Aktivieren',
            'allowed-days'        => 'Erlaubte Tage',
            'display-total-days'  => 'Total Day anzeigens',
            'dispaly-time-format' => 'Zeitformat anzeigen',
            'minimun-time'        => 'Mindestzeit für den Auftragsvorgang',
            'error-message'       => 'Fehlermeldung, wenn Zeitschlitze nicht verfügbar sind.',
            'success-message'     => ':Name erfolgreich gespeichert.',

            'setting' => [
                'title' => 'Einstellungen',
                'info'  => 'Stellen Sie Optionen und Fehlermeldungen fest.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Lieferzeitschlitz',
                'info'  => 'Lieferzeitschlitz.',
            ],
        ],
    ],
];