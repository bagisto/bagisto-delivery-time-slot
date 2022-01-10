<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin;

use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Sales\Repositories\OrderRepository as Order;
use Webkul\DeliveryTimeSlot\Http\Controllers\Controller;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class TimeSlotController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CustomerRepository object
     *
     * @var array
     */
    protected $customerRepository;

    /**
     * TimeSlotsRepository object
     *
     * @var array
     */
    protected $timeSlotsRepository;

    /**
     * order object
     *
     * @var array
     */
    protected $order;

    /**
    *DeliveryTimeSlotsOrdersRepository object
    *
    * @var array
    */
    protected  $timeslotOrderRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository $timeSlotsRepository
     * @param Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository $timeslotOrderRepository;
     * @param Webkul\Sales\Repositories\OrderRepository $order
     */
    public function __construct(
        CustomerRepository $customerRepository,
        DeliveryTimeSlotsRepository $timeSlotsRepository,
        DeliveryTimeSlotsOrdersRepository $timeslotOrderRepository,
        Order $order
    )
    {
        $this->_config = request('_config');

        $this->middleware('admin');

        $this->customerRepository = $customerRepository;

        $this->timeSlotsRepository = $timeSlotsRepository;

        $this->timeslotOrderRepository = $timeslotOrderRepository;

        $this->order = $order;
    }

    /**
     * Method to populate the seller order page which will be populated.
     *
     * @return Mixed
     */
    public function index()
    {
        $data = $this->timeSlotsRepository->findWhere([
            'is_seller' => 0,
            'status' => 1,
        ]);

        $minimuTimeRequired = $data->last();

        return view($this->_config['view'], compact('data', 'minimuTimeRequired'));
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->except('_token');

        $previousData = $this->timeSlotsRepository->findWhere([
            'is_seller' => 0
        ]);

        if (! isset($data['id'])) {
            foreach ($previousData as $previousValue) {
                $previousData->find($previousValue['id'])->update([
                    'status' => 0
                ]);
            }

            $insert = [
                'minimum_time_required' => $data['minimum_time_required'],
                'is_seller' => 0,
            ];

            $this->timeSlotsRepository->create($insert);

            return redirect()->route('admin.timeslot.index');
        }

        // delete Value
        if ($previousData->count() > count($data['delivery_day'])) {
            $newId = array_map('intval', $data['id']);
            foreach ($previousData as $value) {
                if (! in_array($value->id, $newId)) {

                    $value->find($value->id)->update([
                        'status' => 0
                    ]);
                }
            }
        }

        foreach ($data['id'] as $exisitingValue => $id) {

            $result = $this->timeSlotsRepository->findOneWhere(
                ['id' => $id,
                ]);

            if ($result) {

                // conver 24H to 12H
                $startTime = date("g:i a", strtotime("{$data['start_time'][$exisitingValue]}"));
                $endTime = date("g:i a", strtotime("{$data['end_time'][$exisitingValue]}"));
                $result->update([
                    'delivery_day' => $data['delivery_day'][$exisitingValue],
                    'start_time' => strtoupper($startTime),
                    'end_time' => strtoupper($endTime),
                    'time_delivery_quota' => $data['time_delivery_quota'][$exisitingValue],
                    'is_seller' => 0,
                    'minimum_time_required' => $data['minimum_time_required']
                ]);
            }
        }

        foreach ($data['delivery_day'] as $key => $value) {

            if (  ! in_array($data['id'][$key], array_filter($data['id']))) {

                // convert 24H to 12H
                $startTime = date("g:i a", strtotime("{$data['start_time'][$key]}"));
                $endTime = date("g:i a", strtotime("{$data['end_time'][$key]}"));
                $insert = [
                    'delivery_day' => $value,
                    'start_time' => strtoupper($startTime),
                    'end_time' => strtoupper($endTime),
                    'time_delivery_quota' => $data['time_delivery_quota'][$key],
                    'is_seller' => 0,
                    'minimum_time_required' => (int)$data['minimum_time_required']
                ];

                $this->timeSlotsRepository->create($insert);
            }
        }

        session()->flash('success', 'Delivery Time Slots Created.');

        return redirect()->route('admin.timeslot.index');
    }

    /**
     * delivery Orders
     *
     * @param resources
     * Return response
     */
    public function deliveryOrders()
    {
        return view($this->_config['view']);
    }

    /**
     * delivery slots
     *
     * @param resources
     * Return response
     */
    public function deliverySlots()
    {
        return view($this->_config['view']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function invoice()
    {
        return view($this->_config['view']);
    }
}