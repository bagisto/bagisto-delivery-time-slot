<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales;

use Webkul\Core\Traits\PDFHandler;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderRepository as Order;
use Webkul\Sales\Repositories\InvoiceRepository as Invoice;
use Webkul\Admin\Listeners\Invoice as InvoiceListener;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;
use Webkul\Admin\Http\Controllers\Sales\InvoiceController as BaseInvoiceController;

class InvoiceController extends BaseInvoiceController
{
    use PDFHandler;

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
        protected InvoiceListener $invoiceListener,
        protected Invoice $invoice,
        protected Order $order,
        protected DeliveryTimeSlotsOrdersRepository $timeSlotOrderRepository,
    ) {
        $this->orderSlots = collect();
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $invoice = $this->invoice->findOrFail($id);

        $orderId = $invoice->order_id;

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

            foreach ($invoice->items as $key => $item) {
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

        return view('delivery_time_slot::admin.sales.invoices.view')->with([
            'invoice'      => $invoice,
            'timeSlotData' => $timeSlotData,
        ]);
    }

     /**
     * Print and download the for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printInvoice($id)
    {
        $invoice = $this->invoiceRepository->findOrFail($id);

        $orderId = $invoice->order_id;

        $timeFormat = core()->getConfigData('delivery_time_slot.settings.general.time_format');

        $timeSlotOrder = $this->timeSlotOrderRepository->findOneByField('order_id', $orderId);
    
        $timeSlotData = [];

        $timeSlot = $this->timeSlotOrderRepository->with('time_slot')->findOneByField('order_id', $orderId);

        if ($timeSlotOrder) {
            if ($timeSlot->time_slot) {
                $timeStamp1 = strtotime($timeSlot->time_slot->start_time);

                $timeStamp2 = strtotime($timeSlot->time_slot->end_time);
    
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
            }
    
            foreach ($invoice->items as $key => $item) {
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

        return $this->downloadPDF(
            view('admin::sales.invoices.pdf', compact('invoice', 'timeSlotData'))->render(),
            'invoice-' . $invoice->created_at->format('d-m-Y')
        );
    }
}