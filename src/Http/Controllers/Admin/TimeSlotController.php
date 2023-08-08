<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Sales\Repositories\OrderRepository as Order;
use Webkul\DeliveryTimeSlot\Http\Controllers\Controller;
use Webkul\DeliveryTimeSlot\DataGrids\Admin\DeliveyOrdersDataGrid;
use Webkul\DeliveryTimeSlot\DataGrids\Admin\DeliveyTimeSlotsDataGrid;
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
     * @var object
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'delivery_day'     => ['required', 'array'],
            'delivery_day.*'   => ['required'],
            'start_time'       => ['required', 'array'],
            'start_time.*'     => ['required'],
            'end_time'         => ['required', 'array'],
            'end_time.*'       => ['required'],
            'time_delivery_quota' => ['required', 'array'],
            'time_delivery_quota.*' => ['required'],
            'visibility' => ['required', 'array'],
            'visibility.*' => ['required'],
        ]);
    
        $validator->after(function ($validator) use ($request) {
            $timeSlots = [];
            foreach ($request->delivery_day as $index => $day) {
                $slot = $day . $request->start_time[$index];
                if (in_array($slot, $timeSlots)) {
                    $validator->errors()->add('start_time.' . $index, trans('delivery-time-slot::app.admin.layouts.start-time-error'));
                }
                $timeSlots[] = $slot;
            }
        });
    
        if ($validator->fails()) {
            session()->flash('error', $validator->errors()->first());

            return redirect()->back();
        }

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

            $result = $this->timeSlotsRepository->findOneWhere(['id' => $id]);

            if ($result) {
                $result->update([
                    'delivery_day' => $data['delivery_day'][$exisitingValue],
                    'start_time' => $data['start_time'][$exisitingValue],
                    'end_time' => $data['end_time'][$exisitingValue],
                    'time_delivery_quota' => $data['time_delivery_quota'][$exisitingValue],
                    'visibility' => $data['visibility'][$exisitingValue],
                    'is_seller' => 0,
                    'minimum_time_required' => $data['minimum_time_required']
                ]);
            }
        }

        foreach ($data['delivery_day'] as $key => $value) {

            if (! in_array($data['id'][$key], array_filter($data['id']))) {
                $insert = [
                    'delivery_day' => $value,
                    'start_time' => $data['start_time'][$key],
                    'end_time' => $data['end_time'][$key],
                    'time_delivery_quota' => $data['time_delivery_quota'][$key],
                    'visibility' => $data['visibility'][$key],
                    'is_seller' => 0,
                    'minimum_time_required' => (int)$data['minimum_time_required']
                ];

                $data = $this->timeSlotsRepository->findWhere($insert);

                if (! empty($data)) {
                    $this->timeSlotsRepository->create($insert);
                }
            }
        }

        session()->flash('success', 'Delivery Time Slots Created.');

        return redirect()->back();
    }

    /**
     * delivery Orders
     *
     * @param resources
     * Return response
     */
    public function deliveryOrders()
    {
        if (request()->ajax()) {

            return app(DeliveyOrdersDataGrid::class)->toJson();
        }

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
        if (request()->ajax()) {

            return app(DeliveyTimeSlotsDataGrid::class)->toJson();
        }
        
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