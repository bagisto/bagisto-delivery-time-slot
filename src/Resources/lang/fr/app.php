<?php

return [
    'shop' => [
        'tracking-number' => 'Numéro de suivi',

        'delivery-time-slot' => [
            'title'                       => 'Place à temps de livraison',
            'delivery-time-configuration' => 'Configuration de la livraison de tempsn',
            'save-btn'                    => 'Sauvegarder',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Tranches de temps',
            ],
        ],
        
        'checkout' => [
            'time-slots' => 'Places horaires de livraison',
            'seller'     => 'Vendeuse',
            'time'       => 'Temps',
            'date-day'   => 'Date / jour',
            'admin'      => 'Administrer',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Place à temps de livraison',
            'default-delivery-time'     => 'Place à délai de livraison par défautts',
            'save-btn'                  => 'Enregistrer config ',
            'delivery_date'             => 'date',
            'select-day'                => 'Sélectionner la journée',
            'start-time'                => 'Heure de début',
            'end-time'                  => 'Heure de fin',
            'quotas'                    => 'quotas',
            'delivery-orders'           => 'Commandes de livraison',
            'delivery-time-slots'       => 'Places horaires de livraison',
            'admin-delivery-time-slots' => 'Administra les créneaux temporels de livraison ',
            'delivery-slots'            => 'Slots de livraison ',
            'status'                    => 'Statut',  
            'delete-confirm'            => 'Êtes-vous sûr de vouloir supprimer cette fente?',
            'true'                      => 'Vrai',
            'false'                     => 'FAUX',
            'greater-than'              => 'Plus grand que',
            'less-than'                 => 'Moins que',
            'delivery-date-error'       => "La date et le jour ne correspondent pas",
            'delivery-date-day'         => "Date de livraison / jour",
            'delivery-time'             => "Délai de livraison",

            'minimum-required-time' => [
               'title' => "Jours minimaux requis pour le traitement de l'ordre:",
               'info'  => 'Entrez le nombre de jours, par exemple: 5',
            ],

            'btn' => [
                'delete'        => 'Supprimer',
                'add-time-slot' => 'Ajouter un plage horaire',
            ],

            'days' => [
                'monday'    => 'Lundi',
                'tuesday'   => 'Mardi',
                'wednesday' => 'Mercredi',
                'thursday'  => 'Jeudi',
                'friday'    => 'Vendredi',
                'saturday'  => 'Samedi',
                'sunday'    => 'Dimanche',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Nom du Vendeur',
            'delivery-date'       => 'Livraison date',
            'order'               => 'Commande#',
            'delivery-time-from'  => 'Délai de livraison à partir de ',
            'delivery-time-to'    => 'Délai de livraison à',
            'delivery-orders'     => 'Commandes de livraison',
            'delivery-time-slots' => 'Places horaires de livraison',
            'end-time'            => 'Heure de fin',
            'start-time'          => 'Heure de début',
            'allowed-orders'      => 'Ordres autorisés',
            'delivery-day'        => 'Jour de livraison',
            'action'              => 'actions',
            'order-id'            => 'numéro de commande',
            'customer-name'       => 'Nom du client',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => 'Délai de livraison',
                'info'  => 'La livraison de délai de livraison permet aux clients de sélectionner leurs plages horaires préférées pour
                    livraison ou services en fonction de leur disponibilité ou de leur commodité.',
            ],

            'enable'                => 'Activer',
            'allowed-days'          => 'Days autorisés',
            'display-total-days'    => 'Afficher les jours totaux',
            'dispaly-time-format'   => "Format d'heure d'affichage",
            'minimun-time'          => 'Minimum requis pour le processus',
            'error-message'         => "Message d'erreur si les plages horaires non disponibles.",
            'success-message'       => ': le nom enregistré avec succès.',

            'setting' => [
                'title' => 'Paramètres',
                'info'  => "Définissez les options et les messages d'erreur.",
            ],

            'delivery-time-slot' =>  [
                'title' => 'PLAN DE DIRECT',
                'info'  => 'Place à temps de livraison.',
            ],
        ],
    ],
];