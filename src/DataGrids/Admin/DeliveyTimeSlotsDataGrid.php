<?php

namespace Webkul\DeliveryTimeSlot\DataGrids\Admin;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

class DeliveyTimeSlotsDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('delivery_time_slots')

            ->where('delivery_time_slots.status', 1)
            ->where('delivery_time_slots.delivery_day', '<>' ,NULL)
            ->select('delivery_time_slots.id' , 'delivery_time_slots.start_time', 'delivery_time_slots.end_time', 'delivery_time_slots.time_delivery_quota as allowed_orders', 'delivery_time_slots.delivery_day');

        $this->addFilter('allowed_orders', 'delivery_time_slots.time_delivery_quota');
        $this->addFilter('delivery_day', 'delivery_time_slots.delivery_day');
        $this->addFilter('start_time', 'delivery_time_slots.start_time');
        $this->addFilter('end_time', 'delivery_time_slots.end_time');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        // $this->addColumn([
        //     'index' => 'customer_name',
        //     'label' => trans('delivery-time-slot::app.admin.datagrid.seller-name'),
        //     'type' => 'string',
        //     'searchable' => true,
        //     'sortable' => true,
        //     'filterable' => true,
        //     // 'wrapper' => 'Admin'
        // ]);

        $this->addColumn([
            'index' => 'end_time',
            'label' => trans('delivery-time-slot::app.admin.datagrid.end-time'),
            'type' => 'datetime',
            'searchable' => true,
            'sortable' => true,
            'filterable' => false,
            'wrapper' => function($data) {
                $endTime = date("g:i a", strtotime("{$data->end_time}"));
                return strtoupper($endTime);
            }
        ]);

        $this->addColumn([
            'index' => 'start_time',
            'label' => trans('delivery-time-slot::app.admin.datagrid.start-time'),
            'type' => 'integer',
            'searchable' => true,
            'sortable' => true,
            'filterable' => false,
            'wrapper' => function($data) {
                $startTime = date("g:i a", strtotime("{$data->start_time}"));
                return strtoupper($startTime);
            }
        ]);

        $this->addColumn([
            'index' => 'allowed_orders',
            'label' => trans('delivery-time-slot::app.admin.datagrid.allowed-orders'),
            'type' => 'number',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'delivery_day',
            'label' => trans('delivery-time-slot::app.admin.datagrid.delivery-day'),
            'type' => 'string',
            'sortable' => true,
            'searchable' => false,
            'filterable' => true,
            'wrapper' => function ($data) {
                return ucwords($data->delivery_day);
            }
        ]);

        // $this->addColumn([
        //     'index' => 'transaction_agent_id',
        //     'label' => trans('delivery-time-slot::app.admin.datagrid.action'),
        //     'type' => 'string',
        //     'searchable' => false,
        //     'sortable' => false,
        //     'closure' => true,
        //     'wrapper' => function($row) {
        //         return '<a href = "' . route('admin.sales.orders.view', $row->id) .'">' .'Order'. '</a>';
        //     }
        // ]);

    }
}