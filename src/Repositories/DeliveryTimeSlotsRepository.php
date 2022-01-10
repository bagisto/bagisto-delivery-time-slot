<?php

namespace Webkul\DeliveryTimeSlot\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository;

class DeliveryTimeSlotsRepository extends Repository
{
    /**
     * DeliveryTimeSlotsOrdersRepository Instance Object
     *
     * @var \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository
     */
    protected $deliveryTimeSlotsOrdersRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsOrdersRepository  $deliveryTimeSlotsOrdersRepository
     * @return void
     */
    public function __construct(
        DeliveryTimeSlotsOrdersRepository $deliveryTimeSlotsOrdersRepository,
        App $app
    )
    {
        $this->deliveryTimeSlotsOrdersRepository = $deliveryTimeSlotsOrdersRepository;

        parent::__construct($app);
    }
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlots';
    }

    /**
     * get all days
    */
    public function selectDays()
    {
        $timestamp = strtotime('next Sunday');
        $days = array();
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        foreach($days as $day) {
            $allDays[strtolower($day)] = $day;
        }

        return $allDays;
    }

    public function getShippingTimeSlots()
    {
        $this->timeSlotsRepository = app('Webkul\DeliveryTimeSlot\Repositories\DeliveryTimeSlotsRepository');
        $adminAllowesDays = explode(',', core()->getConfigData('delivery_time_slot.settings.general.allowed_days'));
        
        $adminSlots = $this->timeSlotsRepository->findWhere([
            'status'    => 1,
            'is_seller' => 0,
            ['start_time', '<>', NULL],
            ['end_time', '<>', NULL],
        ])->toArray();

        // Defined days
        $dateAndDays = $this->getDateWithDays();
        $timestamp = strtotime('next Monday');
        
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[] = strftime('%A', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
        }

        $minimumRequiredTime = $this->timeSlotsRepository->findWhere([
            'is_seller' => 0,
            'status'    => 1
        ])->last();
        
        $sellersTimeSlots = [];
        foreach ($adminSlots as $adminSlot) {
            $delivery_day = ucfirst($adminSlot['delivery_day']);
            
            if ( in_array($delivery_day, $days) && isset($dateAndDays[$delivery_day]) ) {
                $oldDateTimestamp = strtotime($dateAndDays[$delivery_day]);
                $finalTimeStamp = date('j F, l, Y', $oldDateTimestamp);

                $addedDays = $minimumRequiredTime->minimum_time_required;
                
                $orderProcessDate = date('j F, l, Y', strtotime(date('Y-m-d') . '+' . $addedDays . 'days'));

                //Delivery quotas
                $deliveryQuotasCount = $this->deliveryTimeSlotsOrdersRepository->findWhere([
                    'time_slot_id' => $adminSlot['id'],
                ])->count();

                if ( strtotime($finalTimeStamp) >= strtotime($orderProcessDate) ) {
                    $quotas[$adminSlot['id']] = $deliveryQuotasCount;
                
                    $sellersTimeSlots[0]['seller']  = 'Admin';
                    $sellersTimeSlots[0]['message'] = core()->getConfigData('delivery_time_slot.settings.general.time_slot_error_message') ?: ' Warning: There are no slots avilable';
                    $sellersTimeSlots[0]['slotsNotAvilable']    = true;
                    $sellersTimeSlots[0]['quotas']  = $quotas;
                    $sellersTimeSlots[0]['days'][$finalTimeStamp][] = $adminSlot;
                }
            }
        }
        
        // Admin set days for delivery
        $timeSlots = [];
        foreach ($sellersTimeSlots as $key => $allTimeSlots) {
            if ( isset($sellersTimeSlots[$key]['days']) && $sellersTimeSlots[$key]['days'] ) {
                $timeSlots[$key] = [
                    'seller'            => $allTimeSlots['seller'],
                    'quotas'            => $allTimeSlots['quotas'],
                    'slotsNotAvilable'  => $allTimeSlots['slotsNotAvilable'],
                    'days'              => [],
                ];

                foreach ($sellersTimeSlots[$key]['days'] as $date => $filterDay) {
                    $daysArray = explode(',', $date);
                    $slotOnlyDay = trim($daysArray[1]);

                    if (! empty($adminAllowesDays) && in_array(strtoLower($slotOnlyDay), $adminAllowesDays) ) {
                        $timeSlots[$key]['days'][$date] = $filterDay;
                    }
                }
            } else {
                $timeSlots[$key] = $sellersTimeSlots;
            }
        }

        // If days set by admin
        $totalDaysCountByAdmin = (int) core()->getConfigData('delivery_time_slot.settings.general.total_days');

        $dateArray = [];
        foreach($timeSlots as $k => $timeSlot) {
            if (! $timeSlot['slotsNotAvilable']) {
                foreach ($timeSlot['days'] as $key => $finalDays) {
                    $dateArray[] = $key;
                }
            }

            $filteredDates =  array_reverse($dateArray);

            if (! $timeSlot['slotsNotAvilable']) {
                if ( count($timeSlot['days']) > $totalDaysCountByAdmin ) {
                    $noOfDays = count($timeSlot['days']) - $totalDaysCountByAdmin;
                    
                    for ($i = 0; $i < $noOfDays; $i++) {
                        unset($filteredDates[$i]);
                    }
                    $filteredDays[$k] =  array_values($filteredDates);
                } else {
                    $filteredDays[$k] = $filteredDates;
                }
            } else {
                $filteredDays[$k] = $filteredDates;
            }
        }

        //prepare Slots for user's end
        $finalTimeSlots = [];
        foreach ($timeSlots as $k => $filteredValue) {
            if (! $filteredValue['slotsNotAvilable']) {
                
                foreach ($filteredValue['days'] as $days => $finaValue) {
                    if ( in_array($days, $filteredDays)) {
                        $finalTimeSlots[$k]['days'][$days] = $finaValue;
                        $finalTimeSlots[$k]['seller'] = $filteredValue['seller'];
                        $finalTimeSlots[$k]['quotas'] = $filteredValue['quotas'];
                        $finalTimeSlots[$k]['slotsNotAvilable'] =  $filteredValue['slotsNotAvilable'];
                    }
                }
            } else {
                $finalTimeSlots[$k] = $filteredValue;
            }
        }
        
        if ( $finalTimeSlots == null ) {
            $finalTimeSlots[0]['seller'] = 'Admin';
            $finalTimeSlots[0]['slotsNotAvilable'] = true;
            $finalTimeSlots[0]['message'] = core()->getConfigData('delivery_time_slot.settings.general.time_slot_error_message') ?: ' Warning: There are no slots avilable';
        }

        return $finalTimeSlots;
    }

    public function getDateWithDays()
    {
        $dateAndDays = [];
        $period = new \DatePeriod(
            new \DateTime(), // Start date of the period
            new \DateInterval('P1D'), // Define the intervals as Periods of 1 Day
            6 // Apply the interval 6 times on top of the starting date
        );
        
        foreach ($period as $day) {
            $dateAndDays[$day->format('l')] = $day->format('d F,Y');
        }

        return $dateAndDays;
    }
}