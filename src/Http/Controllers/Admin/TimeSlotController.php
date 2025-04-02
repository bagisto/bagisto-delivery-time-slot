<?php

namespace Webkul\DeliveryTimeSlot\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Sales\Repositories\OrderRepository as Order;
use Webkul\DeliveryTimeSlot\Http\Controllers\Controller;
use Webkul\DeliveryTimeSlot\DataGrids\Admin\DeliveryOrdersDataGrid;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class TimeSlotController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected DeliveryTimeSlotsRepository $timeSlotsRepository,
        protected DeliveryTimeSlotsOrdersRepository $timeslotOrderRepository,
        protected Order $order
    ) {
    }

    /**
     * Method to populate the seller order page which will be populated.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $timeSlots = $this->timeSlotsRepository->get();

        $minimumTimeRequired = $timeSlots->last()->minimum_time_required ?? 1;
         
        return view('delivery_time_slot::admin.default-delivery-slots.index')->with([
            'timeSlots'           => $timeSlots, 
            'minimumTimeRequired' => $minimumTimeRequired,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'minimum_time_required' => 'required|numeric|between:1,7',
            'delivery_date'         => ['required', 'array'],
            'delivery_date.*'       => ['required'],
            'delivery_day'          => ['required', 'array'],
            'delivery_day.*'        => ['required'],
            'start_time'            => ['required', 'array'],
            'start_time.*'          => ['required'],
            'end_time'              => ['required', 'array'],
            'end_time.*'            => ['required'],
            'time_delivery_quota'   => ['required', 'array'],
            'time_delivery_quota.*' => ['required', 'numeric','min:1'],
            'status'                => ['required', 'array'],
            'status.*'              => ['required'],
        ]);    

        if ($validator->fails()) {
            session()->flash('error', trans('delivery_time_slot::app.admin.delivery-time-slot.create-failed'));

            return redirect()->back();
        }

        $slots = [];

        foreach ($request->delivery_date as $index => $date) {
            $slot = $date . $request->start_time[$index];

            if (in_array($slot, $slots)) {
                session()->flash('error', trans('delivery_time_slot::app.admin.delivery-time-slot.errors.start-time-error'));

                return redirect()->back();
            }

            $slots[] = $slot;
        }


        $data = request()->except('_token');

        if ($this->validateSlotsTime()) {
           session()->flash('error', trans('delivery_time_slot::app.admin.delivery-time-slot.errors.already-created'));

           return redirect()->back();
        }

        $previousData = $this->timeSlotsRepository->findWhere([
            'status' => 1,
        ]);

        foreach ($previousData as $value) {
            foreach ($data['id'] as $index => $id) {
               if (
                   $value['id'] !== (int)$id
                   && $value['delivery_date'] == $data['delivery_date'][$index]
                ) {
                    if (
                        $value['start_time'] <= $data['start_time'][$index]
                        && $value['end_time'] >= $data['end_time'][$index]
                    ) {
                        session()->flash('error', trans('delivery_time_slot::app.admin.delivery-time-slot.errors.already-created'));

                        return redirect()->back();
                    }
                }
            }
        }

        foreach ($data['id'] as $existingValue => $id) {
            $result = $this->timeSlotsRepository->findOneByField('id', $id);

            if ($result) {
                $result->update([
                    'delivery_date'         => $data['delivery_date'][$existingValue],
                    'delivery_day'          => $data['delivery_day'][$existingValue],
                    'start_time'            => $data['start_time'][$existingValue],
                    'end_time'              => $data['end_time'][$existingValue],
                    'time_delivery_quota'   => $data['time_delivery_quota'][$existingValue],
                    'status'                => $data['status'][$existingValue],
                    'minimum_time_required' => $data['minimum_time_required'],
                ]);
            }
        }
    
        $ids = $data['id'];

        $deliveryDate = $data['delivery_date'];

        $startTime = $data['start_time'];

        $endTime = $data['end_time'];

        $timeQuota = $data['time_delivery_quota'];

        $status = $data['status'];

        $minimumTimeRequired = $data['minimum_time_required'];

        foreach ($data['delivery_day'] as $key => $value) {
            if (! in_array($ids[$key], array_filter($ids))) {

                $insert = [
                    'delivery_date'         => $deliveryDate[$key],
                    'delivery_day'          => $value,
                    'start_time'            => $startTime[$key],
                    'end_time'              => $endTime[$key],
                    'time_delivery_quota'   => $timeQuota[$key],
                    'status'                => $status[$key],
                    'minimum_time_required' => (int) $minimumTimeRequired,
                ];

                $data = $this->timeSlotsRepository->findWhere($insert);
              
                if (! empty($data)) {
                    $this->timeSlotsRepository->create($insert);
                }
            }
        }

        session()->flash('success', trans('delivery_time_slot::app.admin.delivery-time-slot.create-success'));

        return redirect()->back();
    }

    /**
     * delivery Orders.
     *
     * @return \Illuminate\View\View
     */
    public function deliveryOrders()
    {   
        if (request()->ajax()) {
            return app( DeliveryOrdersDataGrid ::class)->toJson();
        }
    
        return view('delivery_time_slot::admin.timeslots.delivery-orders');
    }

    /**
     * Mass Delete time Slots.
     */
    public function deleteSlots(): JsonResponse
    {
        $this->timeSlotsRepository->delete(request()->input('id'));

        return new JsonResponse([
            'message' => trans('delivery_time_slot::app.admin.delivery-time-slot.delete-success'),
        ]);
    }

    /**
     * Mass Delete time Slots.
     */
    public function massDelete(): JsonResponse
    {
        $timeSlotIds = request()->input('indices');

        try {
            foreach ($timeSlotIds as $timeSlotId) {
                if (empty($timeSlotId)) {
                    return new JsonResponse([
                        'message' => trans('delivery_time_slot::app.admin.delivery-time-slot.create-error'),
                    ], 500);
                }

                $this->timeSlotsRepository->delete($timeSlotId);
            }

            return new JsonResponse([
                'message' => trans('delivery_time_slot::app.admin.delivery-time-slot.delete-success'),
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => trans('delivery_time_slot::app.admin.delivery-time-slot.delete-failed'),
            ], 500);
        }
    }

    /**
     * Here check time slot sections.
     * 
     * @return boolean
     */
    private function validateSlotsTime()
    {
        $request = request()->only([
            'id',
            'delivery_date',
            'delivery_day',
            'start_time',
            'end_time',
        ]);

        foreach ($request['delivery_date'] as $key => $value) {
            if ($request['id'][$key] === "") {
                $previousDataStartTime = $this->timeSlotsRepository->where('delivery_date' , $value)
                   ->pluck('start_time');

                $previousDataEndTime = $this->timeSlotsRepository->where('delivery_date' , $value)
                    ->pluck('end_time');

                if (
                    empty($previousDataEndTime)
                ) {
                    return false;
                }   

                if (
                    $request['start_time'][$key] >= $previousDataStartTime->first()
                    && $request['end_time'][$key] <= $previousDataEndTime->first()
                ) {
                    return true;
                }
            }
        }

        return false;
    }
}