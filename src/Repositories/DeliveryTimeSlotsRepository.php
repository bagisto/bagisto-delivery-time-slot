<?php

namespace Webkul\DeliveryTimeSlot\Repositories;

use Webkul\Core\Eloquent\Repository;

class DeliveryTimeSlotsRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlots';
    }

    /**
     * get all days.
     * 
     * @return array
     */
    public function selectDays()
    {
        $timestamp = strtotime('next Sunday');

        $days = [];
        
        for ($i = 0; $i < 7; $i++) {
            $days[] =  date('l', $timestamp+($i * 24 * 60 *60)); 
        }

        foreach ($days as $day) {
            $allDays[strtolower($day)] = $day;
        }
        
        return $allDays;
    }

    /**
     * get date format.
     * 
     * @return array
     */
    public function dateFormat()
    {
        $formats = [
            '12 Hours', 
            '24 Hours',
        ];

        foreach($formats as $format){
            $dateFormat[strtolower($format)] =  $format;
        }

        return $dateFormat;
    }
}