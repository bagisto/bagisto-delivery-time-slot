<?php

namespace Webkul\MpDeliveryTimeSlot\Http\Controllers\Shop\Account\Seller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Marketplace\Repositories\OrderRepository;
use Webkul\Marketplace\Repositories\SellerRepository;
use Webkul\MpDeliveryTimeSlot\Http\Controllers\Controller;
use Webkul\MpDeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository;
use Webkul\MpDeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

/**
 * SellerTimeSlot controlller
 *
 * @author    Shivam Kumar <shivam.kumar174@webkul.com>
 * @copyright 2020 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SellerTimeSlotController extends Controller
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
     * SellerRepository object
     *
     * @var array
     */
    protected $sellerRepository;

    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $orderRepository;

    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $timeslotOrderRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Customer\Repositories\CustomerRepository  $customerRepository
     * @param \Webkul\Marketplace\Repositories\SellerRepository $sellerRepository
     * @param Webkul\MpDeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository $timeSlotsRepository
     */
    public function __construct(
        CustomerRepository $customerRepository,
        SellerRepository $sellerRepository,
        OrderRepository $orderRepository,
        DeliveryTimeSlotsRepository $timeSlotsRepository,
        DeliveryTimeSlotsOrdersRepository $timeslotOrderRepository
    )
    {
        $this->_config = request('_config');

        $this->middleware('customer');

        $this->customerRepository = $customerRepository;

        $this->sellerRepository = $sellerRepository;

        $this->timeSlotsRepository = $timeSlotsRepository;

        $this->orderRepository = $orderRepository;

        $this->timeslotOrderRepository = $timeslotOrderRepository;

        // $this->selectedDays =  core()->getConfigData('marketplace.settings.mpDeliveryTimeSlot.allowed_days');
    }

    /**
     * Method to populate the seller order page which will be populated.
     *
     * @return Mixed
     */
    public function index()
    {
        $seller = $this->sellerRepository->findOneWhere([
            'customer_id' => auth()->guard('customer')->user()->id
        ]);

        $data = $this->timeSlotsRepository->findWhere([
            'is_seller' => 1,
            'status' => 1,
            'visibility' => 1,
            'marketplace_seller_id' => $seller->id
            ]);

        $minimuTimeRequired = $data->last();

        //if data is empty
        if ($data->isEmpty()) {
            $sellerData = $this->timeSlotsRepository->findWhere([
                'is_seller' => 1,
                'status' => 1,
                'visibility' => 1,
                'marketplace_seller_id' => $seller->id
                ])->last();
            $minimuTimeRequired = $sellerData;
        }

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

        $seller = $this->sellerRepository->findOneWhere([
            'customer_id' => auth()->guard('customer')->user()->id
        ]);

        $previousData = $this->timeSlotsRepository->findWhere([
            'marketplace_seller_id' => $seller->id,
            'is_seller' => 1
        ]);

        if (! isset($data['id'])) {
            foreach ($previousData as $previousValue) {
                $previousData->find($previousValue['id'])->update([
                    'status' => 0
                ]);
            }

            $insert = [
                'minimum_time_required' => $data['minimum_time_required'],
                'is_seller' => 1,
                'marketplace_seller_id' => $seller->id
            ];

            $this->timeSlotsRepository->create($insert);

            return redirect()->route('marketplace.timeslot.seller.index');
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
                'marketplace_seller_id' => $seller->id
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
                    'is_seller' => 1,
                    'marketplace_seller_id' => $seller->id,
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
                    'is_seller' => 1,
                    'minimum_time_required' => (int)$data['minimum_time_required'],
                    'marketplace_seller_id' => $seller->id
                ];

                $this->timeSlotsRepository->create($insert);
            }
        }

        session()->flash('success', trans('delivery-time-slot::app.admin.system.success-message', ['name' => 'TimeSlots']));

        return redirect()->route('marketplace.timeslot.seller.index');
    }

     /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function view($id)
    {
        $seller = $this->sellerRepository->findOneWhere([
            'customer_id' => auth()->guard('customer')->user()->id
        ]);

        $timeSlotData = $this->timeslotOrderRepository->with('time_slot')->findOneWhere([
            'order_id' => $id,
            'marketplace_seller_id' => $seller->id
        ]);

        $sellerOrder = $this->orderRepository->findOneWhere([
            'order_id' => $id,
            'marketplace_seller_id' => $seller->id
        ]);

        return view($this->_config['view'], compact('sellerOrder', 'timeSlotData'));
    }
}