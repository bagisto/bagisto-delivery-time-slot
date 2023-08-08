<?php

return [
    'shop' => [
        'tracking-number' => 'Numéro de suivi',
        'layouts' => [
            'delivery-time-slot' => 'Plage horaire de livraison',
            'delivery-time-configuration' => "Configuration de l'heure de livraison",
            'save-btn' => 'Sauvegarder'
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Tranches de temps',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'Configuration des créneaux horaires',
            'delivery-order-history' => 'Historique des commandes de livraison',
            'minimum-required-time' => 'Temps minimum requis dans le processus de commande:',
            'time-delivery-order' => 'Délai de livraison des commandes',

            'datagrid' => [
                'delivery-date' => 'La date de livraison',
                'orders' => 'Commande#',
                'selected-slot' => 'Emplacement sélectionné',
                'purchased-on' => 'Acheté le',
            ],
        ],

        'checkout' => [
            'time-slots' => 'Tranches de temps',
            'seller' => 'Vendeur',
            'time' => 'Temps',
            'date-day' => 'Date/Jour',
            'admin' => 'Administrateur',

            'cart' => [
                'message' => 'Les créneaux horaires de livraison ne sont pas disponibles pour ce produit.'
            ]
        ],
    ],

    'admin' => [
        'layouts' => [
            'delivery-time-slot' => 'Plage horaire de livraison',
            'default-delivery-time' => 'Plages horaires de livraison par défaut',
            'save-btn' => 'Enregistrer la configuration',
            'select-day' => 'Sélectionnez le jour',
            'start-time' => 'Heure de début',
            'end-time' => 'Heure de fin',
            'quotas' => 'Quotas',
            'delivery-orders' => 'Bons de livraison',
            'delivery-time-slots' => 'Plages horaires de livraison',
            'admin-delivery-time-slots' => 'Créneaux horaires de livraison pour les administrateurs',
            'delivery-slots' => 'Créneaux de livraison',
            'delete-confirm' => 'Êtes-vous sûr de vouloir supprimer cet emplacement ?',
            'start-time-error' => 'L\'heure de début doit être différente pour le même jour de livraison.',

            'btn' => [
                'delete' => 'Supprimer',
                'add-time-slot' => 'Ajouter un créneau horaire',
            ],

            'days' => [
                'monday' => 'Lundi',
                'tuesday' => 'Mardi',
                'wednesday' => 'Mercredi',
                'thursday' => 'Jeudi',
                'friday' => 'Vendredi',
                'saturday' => 'Samedi',
                'sunday' => 'Dimanche',
            ],
        ],

        'datagrid' => [
            'seller-name' => 'Nom du Vendeur',
            'delivery-date' => 'La date de livraison',
            'order' => 'Commande#',
            'delivery-time-from' => 'Délai de livraison à partir de',
            'delivery-time-to' => "Délai de livraison jusqu'à",
            'delivery-orders' => 'Bons de livraison',
            'delivery-time-slots' => 'Plages horaires de livraison',
            'end-time' => 'Heure de fin',
            'start-time' => 'Heure de début',
            'allowed-orders' => 'Commandes autorisées',
            'delivery-day' => 'Jour de livraison',
            'action' => 'Actions',
            'order-id' => 'numéro de commande',
            'customer-name' => 'Nom du client'
        ],

        'system' => [
            'delivery-time-setting' => 'Réglage du délai de livraison',
            'enable' => 'Activer',
            'allowed-days' => 'Jours autorisés',
            'display-total-days' => 'Afficher le nombre total de jours',
            'display-time-format' => 'Format de l\'heure d\'affichage',
            'minimun-time' => 'Temps minimum requis dans le processus de commande',
            'error-message' => "Message d'erreur si les créneaux horaires ne sont pas disponibles.",
            'success-message' => ':name Enregistré avec succès.',
            'setting' => 'Paramètres',
            'delivery-time-slot' => 'Plage horaire de livraison',
            'show-message' => "Afficher un message d'erreur à la boutique si les créneaux ne sont pas disponibles."
        ],
    ],
];