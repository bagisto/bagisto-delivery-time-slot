<?php

namespace Webkul\DeliveryTimeSlot\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Webkul\Checkout\Facades\Cart;
use Webkul\Admin\Http\Controllers\Sales\InvoiceController as BaseInvoiceController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\InvoiceController;
use Webkul\Admin\Http\Controllers\Sales\OrderController as BaseOrderController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\OrderController;
use Webkul\Admin\Http\Controllers\Sales\ShipmentController as BaseShipmentController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\ShipmentController;
use Webkul\Shop\Http\Controllers\API\OnepageController as BaseOnepageController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Shop\API\OnepageController;
use Webkul\Shop\Http\Controllers\Customer\Account\OrderController as BaseShopOrdeController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Customer\OrderController as ShopOrderController;

class DeliveryTimeSlotServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Route::middleware('web')->group( __DIR__ . '/../Routes/api.php');

        Route::middleware('web')->group( __DIR__ . '/../Routes/admin-routes.php');

        $this->app->register(ModuleServiceProvider::class);

        $this->app->register(EventServiceProvider::class);

        $this->app->bind(Cart::class);

        $this->app->bind(BaseOrderController::class, OrderController::class);

        $this->app->bind(BaseInvoiceController::class, InvoiceController::class);

        $this->app->bind(BaseShipmentController::class, ShipmentController::class);

        $this->app->bind(BaseOnepageController::class, OnepageController::class);

        $this->app->bind(BaseShopOrdeController::class, ShopOrderController::class);

        Blade::anonymousComponentPath(__DIR__ . '/../Resources/views/components', 'delivery-time-slot');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'delivery_time_slot');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'delivery_time_slot');

        /**
         * Default Theme page override
         */
        $this->publishes([
            __DIR__ . '/../Resources/views/admin/configuration/'=> resource_path('views/vendor/admin/configuration/'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/checkout/onepage' => resource_path('views/vendor/shop/checkout/onepage'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/admin/sales/invoices' => resource_path('views/vendor/admin/sales/invoices'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/customers/account/orders' => resource_path('views/vendor/shop/customers/account/orders'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/emails/sales/' => resource_path('views/vendor/shop/emails/sales'),
        ]);
        
        $this->overrideModels();

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'delivery_time_slot');
 
        if (core()->getConfigData('delivery_time_slot.settings.general.enable_time_slot')) {
           $this->mergeConfigFrom(
              dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
            );
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
     public function register()
     {
        $this->mergeConfigFrom(
            dirname(__DIR__) .'/Config/system.php',
            'core'
        );
     }
       
    /**
     * Override the existing models
     */
    public function overrideModels()
    {
        $this->app->concord->registerModel(
            \Webkul\Sales\Contracts\Order::class, \Webkul\DeliveryTimeSlot\Models\Order::class
        );
    }
}
