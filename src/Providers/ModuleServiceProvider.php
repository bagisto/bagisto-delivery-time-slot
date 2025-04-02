<?php

namespace Webkul\DeliveryTimeSlot\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlots::class,
        \Webkul\DeliveryTimeSlot\Models\DeliveryTimeSlotsOrders::class,
    ];
}