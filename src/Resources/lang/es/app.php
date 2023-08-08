<?php

return [
    'shop' => [
        'tracking-number' => 'El número de rastreo',
        'layouts' => [
            'delivery-time-slot' => 'Horario de entrega',
            'delivery-time-configuration' => 'Configuración de tiempo de entrega',
            'save-btn' => 'Ahorrar'
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'Ranuras de tiempo',
            ],
        ],

        'seller' => [
            'time-slot-configuration' => 'Configuración de franjas horarias',
            'delivery-order-history' => 'Historial de pedidos de entrega',
            'minimum-required-time' => 'Tiempo mínimo requerido en el proceso de pedido:',
            'time-delivery-order' => 'Órdenes de entrega a tiempo',

            'datagrid' => [
                'delivery-date' => 'Fecha de entrega',
                'orders' => 'Orden#',
                'selected-slot' => 'Ranura seleccionada',
                'purchased-on' => 'Comprado en',
            ],
        ],

        'checkout' => [
            'time-slots' => 'Ranuras de tiempo',
            'seller' => 'Vendedor',
            'time' => 'Tiempo',
            'date-day' => 'Dia de cita',
            'admin' => 'Administrador',

            'cart' => [
                'message' => 'No hay franjas horarias de entrega disponibles para este producto.'
            ]
        ],
    ],

    'admin' => [
        'layouts' => [
            'delivery-time-slot' => 'Horario de entrega',
            'default-delivery-time' => 'Intervalos de tiempo de entrega predeterminados',
            'save-btn' => 'Guardar configuración',
            'select-day' => 'Seleccionar día',
            'start-time' => 'Hora de inicio',
            'end-time' => 'Hora de finalización',
            'quotas' => 'cuotas',
            'delivery-orders' => 'Órdenes de entrega',
            'delivery-time-slots' => 'Franjas de tiempo de entrega',
            'admin-delivery-time-slots' => 'Intervalos de tiempo de entrega del administrador',
            'delivery-slots' => 'Ranuras de entrega',
            'delete-confirm' => 'Estás seguro de que deseas eliminar esta ranura?',
            'start-time-error' => 'El horario de inicio debe ser diferente para el mismo día de entrega.',

            'btn' => [
                'delete' => 'Borrar',
                'add-time-slot' => 'Agregar franja horaria',
            ],

            'days' => [
                'monday' => 'Lunes',
                'tuesday' => 'Martes',
                'wednesday' => 'Miércoles',
                'thursday' => 'Jueves',
                'friday' => 'Viernes',
                'saturday' => 'Sábado',
                'sunday' => 'Domingo',
            ],
        ],

        'datagrid' => [
            'seller-name' => 'Nombre del vendedor',
            'delivery-date' => 'Fecha de entrega',
            'order' => 'Orden#',
            'delivery-time-from' => 'Plazo de entrega desde',
            'delivery-time-to' => 'Tiempo de entrega a',
            'delivery-orders' => 'Órdenes de entrega',
            'delivery-time-slots' => 'Franjas de tiempo de entrega',
            'end-time' => 'Hora de finalización',
            'start-time' => 'Hora de inicio',
            'allowed-orders' => 'Órdenes Permitidas',
            'delivery-day' => 'Dia de entrega',
            'action' => 'Comportamiento',
            'order-id' => 'Solicitar ID',
            'customer-name' => 'Nombre del cliente'
        ],

        'system' => [
            'delivery-time-setting' => 'Configuración del tiempo de entrega',
            'enable' => 'Permitir',
            'allowed-days' => 'Días Permitidos',
            'display-total-days' => 'Mostrar días totales',
            'display-time-format' => 'Formato de tiempo de visualización',
            'minimun-time' => 'Tiempo mínimo requerido en el proceso de pedido',
            'error-message' => 'Mensaje de error si las franjas horarias no están disponibles.',
            'success-message' => ':name Guardado exitosamente.',
            'setting' => 'Ajustes',
            'delivery-time-slot' => 'Horario de entrega',
            'show-message' => 'Mostrar mensaje de error en la tienda si no hay espacios disponibles.'
        ],
    ],
];