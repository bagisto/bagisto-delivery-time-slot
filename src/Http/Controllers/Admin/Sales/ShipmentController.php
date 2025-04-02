<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales;

use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\ShipmentRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;
use Webkul\Admin\Http\Controllers\Sales\ShipmentController as BaseShipmentController;

class ShipmentController extends BaseShipmentController
{
    /**
     * orderSlots object.
     *
     * @var object
     */
    protected $orderSlots;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected OrderRepository $orderRepository,
        protected OrderItemRepository $orderItemRepository,
        protected ShipmentRepository $shipmentRepository,
        protected DeliveryTimeSlotsOrdersRepository $timeSlotOrderRepository,
    ) {
        $this->orderSlots = collect();
    }

    /**
     * Show the view for the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $shipment = $this->shipmentRepository->findOrFail($id);

        $orderId = $shipment->order_id;

        $timeFormat = core()->getConfigData('delivery_time_slot.settings.general.time_format');

        $timeSlotOrder = $this->timeSlotOrderRepository->findOneByField('order_id', $orderId);
    
        $timeSlotData = [];

        $timeSlot = $this->timeSlotOrderRepository->with('time_slot')->findOneByField('order_id', $orderId);

        if ($timeSlotOrder) {
            $timeStamp1 = strtotime($timeSlot->start_time);

            $timeStamp2 = strtotime($timeSlot->end_time);
    
            $startTime = date('H:i A', $timeStamp1);
     
            $endTime = date('H:i A', $timeStamp2);   
                
            if ($timeFormat == "12 hours") { 
                $startTime = date('h:i A', $timeStamp1);
    
                $endTime = date('h:i A', $timeStamp2);  
            }

            $timeSlot['start_time'] = $startTime;

            $timeSlot['end_time'] = $endTime;

            $timeSlot['delivery_date'] = \Carbon\Carbon::parse($timeSlot['delivery_date'])->format('M d,Y');

            $timeSlot['delivery_day'] = ucfirst($timeSlot['delivery_day']);

            foreach ($shipment->items as $key => $item) {
                if ($item->type == 'configurable') {
                    $item = $item->child;
                }

                $this->orderSlots->push([
                    'items'         => [$item],
                    'timeOrderSlot' => $timeSlot ?? null,
                ]);
            }
        }

        $timeSlotData = $this->orderSlots;

        return view('delivery_time_slot::admin.sales.shipments.view')->with([
            'shipment'     => $shipment,  
            'timeSlotData' => $timeSlotData,
        ]);
    }
}