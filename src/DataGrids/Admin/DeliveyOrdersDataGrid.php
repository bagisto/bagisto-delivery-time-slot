<?php

namespace Webkul\DeliveryTimeSlot\DataGrids\Admin;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

class DeliveyOrdersDataGrid extends DataGrid
{
    protected $index = 'id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('delivery_time_slots_orders')
            ->leftJoin('orders', 'orders.id', '=', 'delivery_time_slots_orders.order_id')
            ->leftJoin('delivery_time_slots', 'delivery_time_slots.id', '=', 'delivery_time_slots_orders.time_slot_id')

            ->leftJoin('customers', 'delivery_time_slots_orders.customer_id', '=', 'customers.id')

            ->select(DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_name'), 'delivery_time_slots_orders.delivery_date', 'delivery_time_slots_orders.order_id as delivery_order_id', 'delivery_time_slots.start_time as delivery_time_from', 'delivery_time_slots.end_time as delivery_time_to', 'delivery_time_slots_orders.id' , 'delivery_time_slots_orders.customer_id');

        $this->addFilter('delivery_date', 'delivery_time_slots_orders.delivery_date');
        $this->addFilter('delivery_order_id', 'delivery_time_slots_orders.order_id');
        $this->addFilter('customer_name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'customer_name',
            'label' => trans('delivery-time-slot::app.admin.datagrid.customer-name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function ($data) {
                if ( is_null($data->customer_name))
                    return 'Guest';
                else
                    echo '<a href="' . route('admin.customer.edit', $data->customer_id) . '">' . ucwords($data->customer_name) . '</a>';
            }
        ]);

        $this->addColumn([
            'index' => 'delivery_date',
            'label' => trans('delivery-time-slot::app.admin.datagrid.delivery-date'),
            'type' => 'datetime',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function ($data) {
                $string = \explode(',' ,$data->delivery_date);

                return "{$string[1]}, {$string[2]}";
            }
        ]);

        $this->addColumn([
            'index' => 'delivery_order_id',
            'label' => trans('delivery-time-slot::app.admin.datagrid.order-id'),
            'type' => 'number',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function ($data) {
                echo '<a href="' . route('admin.sales.orders.view', $data->delivery_order_id) . '">' . '#'.$data->delivery_order_id . '</a>';
            }
        ]);

        $this->addColumn([
            'index' => 'delivery_time_from',
            'label' =>trans('delivery-time-slot::app.admin.datagrid.delivery-time-from'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => false,
            'wrapper' => function($data) {
                $deliveryTimeFrom = date("g:i a", strtotime("{$data->delivery_time_from}"));
                return strtoupper($deliveryTimeFrom);
            }
        ]);

        $this->addColumn([
            'index' => 'delivery_time_to',
            'label' =>trans('delivery-time-slot::app.admin.datagrid.delivery-time-to'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => false,
            'wrapper' => function($data) {
                $deliveryTimeTo = date("g:i a", strtotime("{$data->delivery_time_to}"));
                return strtoupper($deliveryTimeTo);
            }
        ]);
    }
}