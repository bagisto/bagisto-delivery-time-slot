<?php

return [
    'shop' => [
        'tracking-number' => '追踪号码',

        'delivery-time-slot' => [
            'title'                       => '送货时间段',
            'delivery-time-configuration' => '送货时间配置',
            'save-btn'                    => '保存',
        ],

        'email' => [
            'customer' => [
                'time-slots' => '时间段',
            ],
        ],
        
        'checkout' => [
            'time-slots' => '送货时间段',
            'seller'     => '卖家',
            'time'       => '时间',
            'date-day'   => '日期/星期',
            'admin'      => '管理员',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => '送货时间段',
            'default-delivery-time'     => '默认送货时间段',
            'save-btn'                  => '保存配置',
            'delivery_date'             => '日期',
            'select-day'                => '选择星期',
            'start-time'                => '开始时间',
            'end-time'                  => '结束时间',
            'quotas'                    => '配额',
            'delivery-orders'           => '送货订单',
            'delivery-time-slots'       => '送货时间段',
            'admin-delivery-time-slots' => '管理员送货时间段',
            'delivery-slots'            => '送货时间段',
            'status'                    => '状态',  
            'delete-confirm'            => '确定要删除此时间段吗？',
            'true'                      => '是',
            'false'                     => '否',
            'greater-than'              => '大于',
            'less-than'                 => '小于',
            'delivery-date-error'       => '日期和星期不匹配',
            'delivery-date-day'         => '送货日期/星期',
            'delivery-time'             => '送货时间',

            'minimum-required-time' => [
               'title' => '订单处理所需最少天数：',
               'info'  =>  '输入天数，例如：5',
            ],

            'btn' => [
                'delete'        => '删除',
                'add-time-slot' => '添加时间段',
            ],

            'days' => [
                'monday'    => '星期一',
                'tuesday'   => '星期二',
                'wednesday' => '星期三',
                'thursday'  => '星期四',
                'friday'    => '星期五',
                'saturday'  => '星期六',
                'sunday'    => '星期日',
            ],
        ],

        'datagrid' => [
            'seller-name'         => '卖家名称',
            'delivery-date'       => '送货日期',
            'order'               => '订单号',
            'delivery-time-from'  => '送货时间从',
            'delivery-time-to'    => '送货时间至',
            'delivery-orders'     => '送货订单',
            'delivery-time-slots' => '送货时间段',
            'end-time'            => '结束时间',
            'start-time'          => '开始时间',
            'allowed-orders'      => '允许订单',
            'delivery-day'        => '送货日期',
            'action'              => '操作',
            'order-id'            => '订单ID',
            'customer-name'       => '客户名称',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => '送货时间设置',
                'info'  => '送货时间段允许客户根据自己的可用性或方便性选择首选的送货时间段或服务。',
            ],

            'enable'                => '启用',
            'allowed-days'          => '允许的日期',
            'display-total-days'    => '显示总天数',
            'dispaly-time-format'   => '显示时间格式',
            'minimun-time'          => '订单处理所需最少时间',
            'error-message'         => '如果时间段不可用的错误消息。',
            'success-message'       => ':name 保存成功。',

            'setting' => [
                'title' => '设置',
                'info'  => '设置选项和错误消息。',
            ],

            'delivery-time-slot' =>  [
                'title' => '送货时间段',
                'info'  =>  '送货时间段。',
            ],
        ],
    ],
];
