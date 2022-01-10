<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales;

use PDF;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * Order repository instance.
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * Invoice repository instance.
     *
     * @var \Webkul\Sales\Repositories\InvoiceRepository
     */
    protected $invoiceRepository;

    /**
     * DeliveryTimeSlotsOrders repository instance.
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\InvoiceRepository  $invoiceRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        InvoiceRepository $invoiceRepository,
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository
    ) {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->orderRepository = $orderRepository;

        $this->invoiceRepository = $invoiceRepository;
        
        $this->deliveryTimeSlotsOrdersRepository = $deliveryTimeSlotsOrdersRepository;

        $this->orderSlots = collect();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $orderId
     * @return \Illuminate\View\View
     */
    public function create($orderId)
    {
        $order = $this->orderRepository->findOrFail($orderId);

        if ($order->payment->method === 'paypal_standard') {
            abort(404);
        }

        if ( core()->getConfigData('delivery_time_slot.settings.general.status') ) {
            $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->findOneByField('order_id', $orderId);

            $timeSlotData = [];
            if ( $deliveryTimeSlot ) {
                foreach ($order->items as $key => $item) {
                    if ($item->type == 'configurable') {
                        $item = $item->child;
                    }

                    $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->with('time_slot')->findOneWhere([
                        'order_id'      => $orderId,
                        'customer_id'   => $order->customer_id
                    ]);

                    if ( $deliveryTimeSlot ) {
                        $this->orderSlots->push([
                            'items'         => [$item],
                            'timeOrderSlot' => $deliveryTimeSlot
                        ]);
                    }
                }
            }

            $timeSlotData = $this->orderSlots;

            return view($this->_config['view'], compact('order', 'timeSlotData'));
        } else {

            return view($this->_config['view'], compact('order'));    
        }
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $invoice = $this->invoiceRepository->findOrFail($id);
        $orderId = $invoice->order_id;

        if ( core()->getConfigData('delivery_time_slot.settings.general.status') ) {
            $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->findOneByField('order_id', $orderId);

            $timeSlotData = [];
            if ( $deliveryTimeSlot ) {
                foreach ($invoice->items as $key => $item) {
                    if ($item->type == 'configurable') {
                        $item = $item->child;
                    }

                    $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->with('time_slot')->findOneWhere([
                        'order_id'      => $orderId
                    ]);

                    if ( $deliveryTimeSlot ) {
                        $this->orderSlots->push([
                            'items'         => [$item],
                            'timeOrderSlot' => $deliveryTimeSlot
                        ]);
                    }
                }
            }

            $timeSlotData = $this->orderSlots;

            return view($this->_config['view'], compact('invoice', 'timeSlotData'));
        } else {

            return view($this->_config['view'], compact('invoice'));    
        }
    }

    /**
     * Print and download the for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $invoice = $this->invoiceRepository->findOrFail($id);
        $orderId = $invoice->order_id;

        if ( core()->getConfigData('delivery_time_slot.settings.general.status') ) {
            $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->findOneByField('order_id', $orderId);

            $timeSlotData = [];
            if ( $deliveryTimeSlot ) {
                foreach ($invoice->items as $key => $item) {
                    if ($item->type == 'configurable') {
                        $item = $item->child;
                    }

                    $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->with('time_slot')->findOneWhere([
                        'order_id'      => $orderId
                    ]);

                    if ( $deliveryTimeSlot ) {
                        $this->orderSlots->push([
                            'items'         => [$item],
                            'timeOrderSlot' => $deliveryTimeSlot
                        ]);
                    }
                }
            }

            $timeSlotData = $this->orderSlots;

            $html = view('admin::sales.invoices.pdf', compact('invoice', 'timeSlotData'))->render();
        } else {
            $html = view('admin::sales.invoices.pdf', compact('invoice'))->render();
        }

        return PDF::loadHTML($this->adjustArabicAndPersianContent($html))
            ->setPaper('a4')
            ->download('invoice-' . $invoice->created_at->format('d-m-Y') . '.pdf');
    }

    /**
     * Adjust arabic and persian content.
     *
     * @param  string  $html
     * @return string
     */
    private function adjustArabicAndPersianContent($html)
    {
        $arabic = new \ArPHP\I18N\Arabic();

        $p = $arabic->arIdentify($html);

        for ($i = count($p) - 1; $i >= 0; $i -= 2) {
            $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i - 1], $p[$i] - $p[$i - 1]));
            $html   = substr_replace($html, $utf8ar, $p[$i - 1], $p[$i] - $p[$i - 1]);
        }

        return $html;
    }
}
