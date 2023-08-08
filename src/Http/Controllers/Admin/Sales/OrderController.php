<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * DeliveryTimeSlotsOrdersRepository object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * Create a new controller instance.
     *
     * @param   \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param   \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository $timeslotOrderRepository;
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository
    )
    {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->orderRepository = $orderRepository;

        $this->deliveryTimeSlotsOrdersRepository = $deliveryTimeSlotsOrdersRepository;

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
        $order = $this->orderRepository->findOrFail($id);

        if (core()->getConfigData('delivery_time_slot.settings.general.status')) {
            $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->findOneByField('order_id', $id);

            $timeSlotData = [];
            if ($deliveryTimeSlot) {
                foreach ($order->items as $key => $item) {
                    if ($item->type == 'configurable') {
                        $item = $item->child;
                    }

                    $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->with('time_slot')->findOneWhere([
                        'order_id'      => $id,
                        'customer_id'   => $order->customer_id
                    ]);

                    if ($deliveryTimeSlot) {
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
}