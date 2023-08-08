<?php

namespace Webkul\DeliveryTimeSlot\DataGrids\Shop;

use Webkul\Ui\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class OrderDataGrid extends DataGrid
{
    /**
     * Index.
     *
     * @var string
     */
    protected $index = 'id';

    /**
     * Sort order.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('orders as order')
            ->addSelect('order.id', 'order.increment_id', 'order.status', 'order.created_at', 'order.grand_total', 'order.order_currency_code')
            ->where('customer_id', auth()->guard('customer')->user()->id);

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'increment_id',
            'label'      => trans('shop::app.customer.account.order.index.order_id'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('shop::app.customer.account.order.index.date'),
            'type'       => 'datetime',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'wrapper' => function ($data) {
                if (core()->getConfigData('delivery_time_slot.settings.general.display_time_format') == 12) {
                    return date('Y-m-d h:i:s A', strtotime($data->created_at));
                }

                return $data->created_at;
            }
        ]);

        $this->addColumn([
            'index'      => 'grand_total',
            'label'      => trans('shop::app.customer.account.order.index.total'),
            'type'       => 'number',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($value) {
                return core()->formatPrice($value->grand_total, $value->order_currency_code);
            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('shop::app.customer.account.order.index.status'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($value) {
                if ($value->status == 'processing') {
                    return '<span class="badge badge-md badge-success">' . trans('shop::app.customer.account.order.index.processing') . '</span>';
                } elseif ($value->status == 'completed') {
                    return '<span class="badge badge-md badge-success">' . trans('shop::app.customer.account.order.index.completed') . '</span>';
                } elseif ($value->status == "canceled") {
                    return '<span class="badge badge-md badge-danger">' . trans('shop::app.customer.account.order.index.canceled') . '</span>';
                } elseif ($value->status == "closed") {
                    return '<span class="badge badge-md badge-info">' . trans('shop::app.customer.account.order.index.closed') . '</span>';
                } elseif ($value->status == "pending") {
                    return '<span class="badge badge-md badge-warning">' . trans('shop::app.customer.account.order.index.pending') . '</span>';
                } elseif ($value->status == "pending_payment") {
                    return '<span class="badge badge-md badge-warning">' . trans('shop::app.customer.account.order.index.pending-payment') . '</span>';
                } elseif ($value->status == "fraud") {                    
                    return '<span class="badge badge-md badge-danger">' . trans('shop::app.customer.account.order.index.fraud') . '</span>';
                }
            },
            'filterable' => true,
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('ui::app.datagrid.view'),
            'type'   => 'View',
            'method' => 'GET',
            'route'  => 'timeslot.customer.orders.view',
            'icon'   => 'icon eye-icon',
        ], true);
    }
}
