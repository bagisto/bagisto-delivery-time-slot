<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Customer;

use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class OrderController extends Controller
{
    /**
     * Current customer.
     */
    protected $currentCustomer;

    /**
     * OrderrRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * InvoiceRepository object
     *
     * @var \Webkul\Sales\Repositories\InvoiceRepository
     */
    protected $invoiceRepository;

    /**
     * DeliveryTimeSlotsOrdersRepository object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Order\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Order\Repositories\InvoiceRepository  $invoiceRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository   $deliveryTimeSlotsOrdersRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        InvoiceRepository $invoiceRepository,
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository
    )
    {
        $this->middleware('customer');

        $this->currentCustomer = auth()->guard('customer')->user();

        $this->orderRepository = $orderRepository;

        $this->invoiceRepository = $invoiceRepository;

        $this->deliveryTimeSlotsOrdersRepository = $deliveryTimeSlotsOrdersRepository;

        $this->orderSlots = collect();

        parent::__construct();
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $order = $this->orderRepository->findOneWhere([
            'customer_id' => $this->currentCustomer->id,
            'id'          => $id,
        ]);
        
        if (! $order) {
            abort(404);
        }

        if ( core()->getConfigData('delivery_time_slot.settings.general.status') ) {
            $deliveryTimeSlotsOrder = $this->deliveryTimeSlotsOrdersRepository->findOneByField('order_id', $id);

            $timeSlotData = [];
            if ( $deliveryTimeSlotsOrder ) {
                foreach ($order->items as $key => $item) {
                    if ($item->type == 'configurable') {
                        $item = $item->child;
                    }

                    $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->with('time_slot')->findOneWhere([
                        'order_id'      => $id,
                        'customer_id'   => $order->customer_id
                    ]);

                    if ( $deliveryTimeSlot ) {
                        $this->orderSlots->push([
                            'items'         => [$item],
                            'timeOrderSlot' => $deliveryTimeSlot
                        ]);
                    }
                }

                $timeSlotData = $this->orderSlots;
            }

            return view($this->_config['view'], compact('order', 'timeSlotData'));
        } else {
            return view($this->_config['view'], compact('order'));
        }
    }
}