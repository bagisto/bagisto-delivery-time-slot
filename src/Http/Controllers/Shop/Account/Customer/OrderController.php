<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Customer;

use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;
use Webkul\Shop\Http\Controllers\Customer\Account\OrderController as BaseOrdeController;

class OrderController extends BaseOrdeController
{
    /**
     * orderSlots object
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
        protected InvoiceRepository $invoiceRepository,
        protected DeliveryTimeSlotsOrdersRepository $timeslotOrderRepository
    ) {
        $this->orderSlots = collect();
    }

    /**
     * Show the view for the specified resource basically user of view order.
     *
     * @param int $id
     * @return mixed
     */
    public function view($id)
    {
        $customerId = auth()->guard('customer')->user()->id;

        $order = $this->orderRepository->findWhere([
            'customer_id' => $customerId,
            'id'          => $id,
        ]);

        $timeFormat = core()->getConfigData('delivery_time_slot.settings.general.time_format');

        $timeSlotOrder = $this->timeslotOrderRepository->findOneByField('order_id', $id);
    
        $timeSlotData = [];

        $timeSlot = $this->timeslotOrderRepository->with('time_slot')->findOneByField('order_id', $id);

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

            foreach ($order->items as $key => $item) {
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

        if (! $order) {
            return;
        }

        return view('delivery_time_slot::shop.customers.account.orders.view')->with([
            'order'        => $order, 
            'timeSlotData' => $timeSlotData,
        ]);
    }
}