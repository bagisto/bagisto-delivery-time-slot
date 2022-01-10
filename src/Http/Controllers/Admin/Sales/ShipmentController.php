<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\ShipmentRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class ShipmentController extends Controller
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
     * OrderItemRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderItemRepository
     */
    protected $orderItemRepository;

    /**
     * ShipmentRepository object
     *
     * @var \Webkul\Sales\Repositories\ShipmentRepository
     */
    protected $shipmentRepository;

    /**
     * DeliveryTimeSlotsOrdersRepository object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\ShipmentRepository   $shipmentRepository
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     * @param  \Webkul\Sales\Repositories\OrderitemRepository  $orderItemRepository
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository  $deliveryTimeSlotsOrdersRepository
     * @return void
     */
    public function __construct(
        ShipmentRepository $shipmentRepository,
        OrderRepository $orderRepository,
        OrderItemRepository $orderItemRepository,
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository
    )
    {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->orderRepository = $orderRepository;

        $this->orderItemRepository = $orderItemRepository;

        $this->shipmentRepository = $shipmentRepository;

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

        if (! $order->channel || !$order->canShip()) {
            session()->flash('error', trans('admin::app.sales.shipments.creation-error'));

            return redirect()->back();
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
        $shipment = $this->shipmentRepository->findOrFail($id);
        $orderId = $shipment->order_id;

        if ( core()->getConfigData('delivery_time_slot.settings.general.status') ) {
            $deliveryTimeSlot = $this->deliveryTimeSlotsOrdersRepository->findOneByField('order_id', $orderId);

            $timeSlotData = [];
            if ( $deliveryTimeSlot ) {
                foreach ($shipment->items as $key => $item) {
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

            return view($this->_config['view'], compact('shipment', 'timeSlotData'));
        } else {

            return view($this->_config['view'], compact('shipment'));
        }
    }
}
