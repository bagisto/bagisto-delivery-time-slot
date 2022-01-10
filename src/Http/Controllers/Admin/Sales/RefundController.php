<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\RefundRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @var array
     */
    protected $_config;

    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * OrderItemRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderItemRepository
     */
    protected $orderItemRepository;

    /**
     * RefundRepository object
     *
     * @var \Webkul\Sales\Repositories\RefundRepository
     */
    protected $refundRepository;

    /**
     * DeliveryTimeSlotsOrdersRepository object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\OrderItemRepository  $orderItemRepository
     * @param  \Webkul\Sales\Repositories\RefundRepository  $refundRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository  $deliveryTimeSlotsOrdersRepository
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        RefundRepository $refundRepository,
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository
    )
    {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->orderRepository = $orderRepository;

        $this->orderItemRepository = $orderItemRepository;

        $this->refundRepository = $refundRepository;

        $this->deliveryTimeSlotsOrdersRepository = $deliveryTimeSlotsOrdersRepository;

        $this->orderSlots = collect();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $orderId
     * @return \Illuminate\Http\View
     */
    public function create($orderId)
    {
        $order = $this->orderRepository->findOrFail($orderId);

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
     * @return \Illuminate\Http\View
     */
    public function view($id)
    {
        $refund = $this->refundRepository->findOrFail($id);
        $orderId = $refund->order_id;

        if ( core()->getConfigData('delivery_time_slot.settings.general.status') ) {
            $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->findOneByField('order_id', $orderId);

            $timeSlotData = [];
            if ( $deliveryTimeSlot ) {
                foreach ($refund->items as $key => $item) {
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

            return view($this->_config['view'], compact('refund', 'timeSlotData'));
        } else {

            return view($this->_config['view'], compact('refund'));
        }
    }
}
