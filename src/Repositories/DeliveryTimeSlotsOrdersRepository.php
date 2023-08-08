<?php

namespace Webkul\DeliveryTimeSlot\Repositories;

use Webkul\Core\Eloquent\Repository;

class DeliveryTimeSlotsOrdersRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\DeliveryTimeSlot\Contracts\DeliveryTimeSlotsOrders';
    }
}