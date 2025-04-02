<?php

return [
    'shop' => [
        'tracking-number' => '追跡番号',

        'delivery-time-slot' => [
            'title'                       => '配信時間スロット',
            'delivery-time-configuration' => '時間配送構成',
            'save-btn'                    => '保存',
        ],

        'email' => [
            'customer' => [
                'time-slots' => 'タイムスロット',
            ],
        ],
        
        'checkout' => [
            'time-slots' => '配信時間スロット',
            'seller'     => '売り手',
            'time'       => '時間',
            'date-day'   => '日付/日',
            'admin'      => '管理者',
        ],
    ],

    'admin' => [
        'delivery-time-slot' => [
            'title'                     => '配信時間スロット',
            'default-delivery-time'     => 'デフォルトの配信時間スロット',
            'save-btn'                  => 'Save Config',
            'delivery_date'             => '日付',
            'select-day'                => '日を選択します',
            'start-time'                => '始まる時間',
            'end-time'                  => '終了時間',
            'quotas'                    => '割り当て',
            'delivery-orders'           => '配達注文',
            'delivery-time-slots'       => '配達時間スロット ',
            'admin-delivery-time-slots' => '管理時間スロット',
            'delivery-slots'            => '配信スロット',
            'status'                    => '状態',  
            'delete-confirm'            => 'このスロットを削除したいですか？',
            'true'                      => '真実',
            'false'                     => '間違い',
            'greater-than'              => '「より大きい」',
            'less-than'                 => '未満',
            'delivery-date-error'       => "日付と日は一致しませんh",
            'delivery-date-day'         => "配達日/日",
            'delivery-time'             => "納期",

            'minimum-required-time' => [
               'title' => '注文処理に必要な最低日：',
               'info'  =>  '日数を入力します。例：5',
            ],

            'btn' => [
                'delete'        => '消去',
                'add-time-slot' => 'タイムスロットを追加します',
            ],

            'days' => [
                'monday'    => '月曜日',
                'tuesday'   => '火曜日',
                'wednesday' => '水曜日',
                'thursday'  => '木曜日',
                'friday'    => '金曜日',
                'saturday'  => '土曜日',
                'sunday'    => '日曜日',
            ],
        ],

        'datagrid' => [
            'seller-name'         => '売り手名 ',
            'delivery-date'       => '配信データe',
            'order'               => '注文＃',
            'delivery-time-from'  => 'からの配達時間',
            'delivery-time-to'    => '配達時間',
            'delivery-orders'     => '配達注文',
            'delivery-time-slots' => '配信時間スロット',
            'end-time'            => '終了時間',
            'start-time'          => '始まる時間',
            'allowed-orders'      => '許可された注文',
            'delivery-day'        => '配達日',
            'action'              => '行動',
            'order-id'            => 'IDを注文します',
            'customer-name'       => '顧客名',
        ],

        'system' => [
            'delivery-time-setting' => [
                'title' => '配達時間設定',
                'info'  => '配信タイムスロットにより、顧客は希望するタイムスロットを選択できます
                    可用性または利便性に基づく配送またはサービス。',
            ],

            'enable'                => '有効にする',
            'allowed-days'          => '許可された日',
            'display-total-days'    => '合計日を表示します',
            'dispaly-time-format'   => '表示時間形式を表示しますt',
            'minimun-time'          => '順序プロセスの最低必要時間',
            'error-message'         => 'エラーメッセージタイムスロットが使用できない場合。',
            'success-message'       => ':名前が正常に保存されました.',

            'setting' => [
                'title' => '設定',
                'info'  => 'オプションとエラーメッセージを設定します。',
            ],

            'delivery-time-slot' =>  [
                'title' => '配信時間スロット',
                'info'  => '配信時間スロット。',
            ],
        ],
    ],
];