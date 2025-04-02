<?php

namespace Webkul\DeliveryTimeSlot\DataGrids\Admin;

use Illuminate\Support\Facades\DB;
use Webkul\Sales\Models\OrderAddress;
use Webkul\DataGrid\DataGrid;

class DeliveyOrdersDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('delivery_time_slots_orders')
        ->leftJoin('orders', 'orders.id', '=', 'delivery_time_slots_orders.order_id')
        ->leftJoin('delivery_time_slots', 'delivery_time_slots.id', '=', 'delivery_time_slots_orders.time_slot_id')
        ->leftJoin('customers', 'delivery_time_slots_orders.customer_id', '=', 'customers.id')
        ->leftJoin('addresses as order_address_shipping', function ($leftJoin) {
            $leftJoin->on('order_address_shipping.order_id', '=', 'orders.id')
                ->where('order_address_shipping.address_type', OrderAddress::ADDRESS_TYPE_SHIPPING);
        })
        ->leftJoin('addresses as order_address_billing', function ($leftJoin) {
            $leftJoin->on('order_address_billing.order_id', '=', 'orders.id')
                ->where('order_address_billing.address_type', OrderAddress::ADDRESS_TYPE_BILLING);
        })
        
        ->select(DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_name'), 
           'delivery_time_slots_orders.delivery_date', 
           'delivery_time_slots_orders.order_id as delivery_order_id', 
           'delivery_time_slots_orders.start_time as delivery_time_from', 
           'delivery_time_slots_orders.end_time as delivery_time_to', 
           'delivery_time_slots_orders.id' , 
           'delivery_time_slots_orders.customer_id'
        )
        ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name) as billed_to'))
        ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'order_address_shipping.last_name) as shipped_to'));
        
        $this->addFilter('delivery_time_from', 'delivery_time_slots_orders.start_time');
        $this->addFilter('delivery_time_to', 'delivery_time_slots_orders.end_time');
        $this->addFilter('delivery_date', 'delivery_time_slots_orders.delivery_date');
        $this->addFilter('delivery_order_id', 'delivery_time_slots_orders.order_id');
        $this->addFilter('customer_name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));
        $this->addFilter('billed_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name)'));
        $this->addFilter('shipped_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'order_address_shipping.last_name)'));

        return $queryBuilder;
    }

    /**
     * Prepare columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'customer_name',
            'label'      => trans('delivery-time-slot::app.admin.datagrid.customer-name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                if ($row->customer_name) {
                    return '<a class="text-blue-600" href="' .route('admin.customers.customers.view', $row->customer_id) . '">'. $row->customer_name . '</a>';
                }

                return trans('delivery-time-slot::app.admin.datagrid.guest');   
            },
        ]);

        $this->addColumn([
            'index'      => 'billed_to',
            'label'      => trans('delivery-time-slot::app.admin.datagrid.billed-to'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'shipped_to',
            'label'      => trans('delivery-time-slot::app.admin.datagrid.shipped-to'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'delivery_date',
            'label'      => trans('delivery-time-slot::app.admin.datagrid.delivery-date'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return date('d F Y', strtotime($row->delivery_date));
            }
        ]);

        $this->addColumn([
            'index'      => 'delivery_order_id',
            'label'      => trans('delivery-time-slot::app.admin.datagrid.order-id'),
            'type'       => 'integer',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return '<a class="text-blue-600" href="' . route('admin.sales.orders.view', $row->delivery_order_id) . '">' . '#'. $row->delivery_order_id . '</a>';
            },
        ]);

        $this->addColumn([
            'index'      => 'delivery_time_from',
            'label'      => trans('delivery-time-slot::app.admin.datagrid.delivery-time-from'),
            'type'       => 'date',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => true,
            'closure'    => function($row) {
                $deliveryTimeFrom = date("G:i", strtotime("{$row->delivery_time_from}"));

                return strtoupper($deliveryTimeFrom);
            },
        ]);

        $this->addColumn([
            'index'      => 'delivery_time_to',
            'label'      => trans('delivery-time-slot::app.admin.datagrid.delivery-time-to'),
            'type'       => 'date',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => true,
            'closure'    => function($row) {
                $deliveryTimeTo = date("G:i ", strtotime("{$row->delivery_time_to}"));

                return strtoupper($deliveryTimeTo);
            },
        ]);  
    }
}