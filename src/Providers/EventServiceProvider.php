<?php

namespace Webkul\DeliveryTimeSlot\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('bagisto.admin.layout.head', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('delivery_time_slot::admin.layouts.style');
        });

        Event::listen('bagisto.shop.layout.body.before', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('delivery_time_slot::shop.default.layouts.master');
        });

    }
}
