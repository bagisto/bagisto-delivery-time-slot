<?php

return [
    'shop' => [
        'tracking-number' => 'El número de rastreo',

        'delivery-time-slot' => [
            'title'                       => 'Ranura de tiempo de entrega',
            'delivery-time-configuration' => 'Entrega de tiempo configuración',
            'save-btn'                    => 'Ahorrar',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Ranuras de tiempo',
            ],
        ],

        'checkout' => [
            'time-slots' => 'Ranuras de tiempo de entrega',
            'seller'     => 'Vendedora',
            'time'       => 'Tiempo',
            'date-day'   => 'Fecha/Day',
            'admin'      => 'Administración',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => 'Ranura de tiempo de entrega',
            'default-delivery-time'     => 'Ranuras de tiempo de entrega predeterminadas',
            'save-btn'                  => 'Guardar config',
            'delivery_date'             => 'Fecha',
            'select-day'                => 'Día de selección',
            'start-time'                => 'Hora de inicio',
            'end-time'                  => 'Hora de finalización',
            'quotas'                    => 'Cuotas',
            'delivery-orders'           => 'Pedidos de entrega',
            'delivery-time-slots'       => 'Ranuras de tiempo de entrega',
            'admin-delivery-time-slots' => 'Ranuras de tiempo de entrega de administrador',
            'delivery-slots'            => 'Espacios de entrega',
            'status'                    => 'Estado',  
            'delete-confirm'            => '¿Estás seguro de que quieres eliminar esta ranura?',
            'true'                      => 'Verdadero',
            'false'                     => 'FALSO',
            'greater-than'              => 'Mas grande que',
            'less-than'                 => 'Menos que',
            'delivery-date-error'       => "La fecha y el día no coinciden",
            'delivery-date-day'         => "Fecha de entrega/día",
            'delivery-time'             => "El tiempo de entrega",

            'minimum-required-time' => [
               'title' => 'Días mínimos requeridos en el procesamiento de orden:',
               'info'  => 'Ingrese el número de días, por ejemplo: 5',
            ],

            'btn' => [
                'delete'        => 'Borrar',
                'add-time-slot' => 'Agregar ranura de tiempo',
            ],

            'days' => [
                'monday'    => 'Lunes',
                'tuesday'   => 'Martes',
                'wednesday' => 'Miércoles',
                'thursday'  => 'Jueves',
                'friday'    => 'Viernes',
                'saturday'  => 'Sábado',
                'sunday'    => 'Domingo',
            ],
        ],

        'datagrid' => [
            'seller-name'         => 'Nombre del vendedor',
            'delivery-date'       => 'Fecha de entrega',
            'order'               => 'Orden#',
            'delivery-time-from'  => 'Tiempo de entrega de',
            'delivery-time-to'    => 'Tiempo de entrega para',
            'delivery-orders'     => 'Pedidos de entrega',
            'delivery-time-slots' => 'Ranuras de tiempo de entrega',
            'end-time'            => 'Hora de finalización',
            'start-time'          => 'Hora de inicio',
            'allowed-orders'      => 'Pedidos permitidos',
            'delivery-day'        => 'Dia de entrega',
            'action'              => 'Comportamiento',
            'order-id'            => 'Solicitar ID',
            'customer-name'       => 'Nombre del cliente',
        ],

        'system' => [

            'delivery-time-setting' => [
                'title' => 'Configuración de tiempo de entrega',
                'info'  => 'La ranura de tiempo de entrega permite a los clientes seleccionar sus intervalos de tiempo preferidos para
                    entrega o servicios basados en su disponibilidad o conveniencia.',
            ],

            'enable'              => 'Permitir',
            'allowed-days'        => 'Días permitidos',
            'display-total-days'  => 'Mostrar días totales',
            'dispaly-time-format' => 'Formato de tiempo de visualización',
            'minimun-time'        => 'Mínimo tiempo requerido en el proceso',
            'error-message'       => 'Mensaje de error si las ranuras de tiempo no están disponibles.',
            'success-message'     => ': Nombre guardado con éxito.',

            'setting' => [
                'title' => 'Ajustes',
                'info'  => 'Set options and error messages.',
            ],

            'delivery-time-slot' =>  [
                'title' => 'Ranura de tiempo de entrega',
                'info'  =>  'Ranura de tiempo de entrega.',
            ],
        ],
    ],
];