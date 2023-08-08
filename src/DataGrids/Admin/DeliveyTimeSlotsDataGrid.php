<?php

namespace Webkul\DeliveryTimeSlot\DataGrids\Admin;

use Webkul\Ui\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

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
        $this->addColumn([
            'index' => 'delivery_day',
            'label' => trans('delivery-time-slot::app.admin.datagrid.delivery-day'),
            'type' => 'string',
            'sortable' => false,
            'searchable' => true,
            'filterable' => true,
            'wrapper' => function ($data) {
                return ucwords($data->delivery_day);
            }
        ]);

        $this->addColumn([
            'index' => 'start_time',
            'label' => trans('delivery-time-slot::app.admin.datagrid.start-time'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => false,
            'wrapper' => function ($data) {
                if (core()->getConfigData('delivery_time_slot.settings.general.display_time_format') == 12) {
                    return date('h:i A', strtotime($data->start_time));
                }

                return $data->start_time;
            }
        ]);

        $this->addColumn([
            'index' => 'end_time',
            'label' => trans('delivery-time-slot::app.admin.datagrid.end-time'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => false,
            'wrapper' => function ($data) {
                if (core()->getConfigData('delivery_time_slot.settings.general.display_time_format') == 12) {
                    return date('h:i A', strtotime($data->end_time));
                }

                return $data->end_time;
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
    }
}