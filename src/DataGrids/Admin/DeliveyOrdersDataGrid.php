<?php

namespace Webkul\DeliveryTimeSlot\DataGrids\Admin;

use Webkul\Ui\DataGrid\DataGrid;
use Webkul\Sales\Models\OrderAddress;
use Illuminate\Support\Facades\DB;

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
            ->leftJoin('addresses as order_address_shipping', function ($leftJoin) {
                $leftJoin->on('order_address_shipping.order_id', '=', 'orders.id')
                    ->where('order_address_shipping.address_type', OrderAddress::ADDRESS_TYPE_SHIPPING);
            })
            ->leftJoin('addresses as order_address_billing', function ($leftJoin) {
                $leftJoin->on('order_address_billing.order_id', '=', 'orders.id')
                    ->where('order_address_billing.address_type', OrderAddress::ADDRESS_TYPE_BILLING);
            })
            
            ->select(DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_name'), 'delivery_time_slots_orders.delivery_date', 'delivery_time_slots_orders.order_id as delivery_order_id', 'delivery_time_slots.start_time as delivery_time_from', 'delivery_time_slots.end_time as delivery_time_to', 'delivery_time_slots_orders.id' , 'delivery_time_slots_orders.customer_id')
            ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name) as billed_to'))
            ->addSelect(DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'order_address_shipping.last_name) as shipped_to'));

        $this->addFilter('delivery_date', 'delivery_time_slots_orders.delivery_date');
        $this->addFilter('delivery_order_id', 'delivery_time_slots_orders.order_id');
        $this->addFilter('customer_name', DB::raw('CONCAT(customers.first_name, " ", customers.last_name)'));
        $this->addFilter('billed_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_billing.first_name, " ", ' . DB::getTablePrefix() . 'order_address_billing.last_name)'));
        $this->addFilter('shipped_to', DB::raw('CONCAT(' . DB::getTablePrefix() . 'order_address_shipping.first_name, " ", ' . DB::getTablePrefix() . 'order_address_shipping.last_name)'));

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
            'filterable' => false,
            'closure' => function ($data) {
                if (is_null($data->customer_name)) {
                    return 'Guest';
                }                    
                
                return '<a href="' . route('admin.customer.edit', $data->customer_id) . '">' . ucwords($data->customer_name) . '</a>';                    
            }
        ]);

        $this->addColumn([
            'index'      => 'billed_to',
            'label'      => trans('admin::app.datagrid.billed-to'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'shipped_to',
            'label'      => trans('admin::app.datagrid.shipped-to'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index' => 'delivery_date',
            'label' => trans('delivery-time-slot::app.admin.datagrid.delivery-date'),
            'type' => 'datetime',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function ($data) {
                return date('d F Y', strtotime($data->delivery_date));
            }
        ]);

        $this->addColumn([
            'index' => 'delivery_order_id',
            'label' => trans('delivery-time-slot::app.admin.datagrid.order-id'),
            'type' => 'number',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true,
            'closure' => function ($data) {                
                return '<a href="' . route('admin.sales.orders.view', $data->delivery_order_id) . '">' . '#'.$data->delivery_order_id . '</a>';
            }
        ]);

        $this->addColumn([
            'index' => 'delivery_time_from',
            'label' =>trans('delivery-time-slot::app.admin.datagrid.delivery-time-from'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => false,
            'wrapper' => function ($data) {
                if (core()->getConfigData('delivery_time_slot.settings.general.display_time_format') == 12) {
                    return date('h:i A', strtotime($data->delivery_time_from));
                }

                return $data->delivery_time_from;
            }
        ]);

        $this->addColumn([
            'index' => 'delivery_time_to',
            'label' =>trans('delivery-time-slot::app.admin.datagrid.delivery-time-to'),
            'type' => 'datetime',
            'sortable' => true,
            'searchable' => false,
            'filterable' => false,
            'wrapper' => function ($data) {
                if (core()->getConfigData('delivery_time_slot.settings.general.display_time_format') == 12) {
                    return date('h:i A', strtotime($data->delivery_time_to));
                }

                return $data->delivery_time_to;
            }
        ]);
    }
}