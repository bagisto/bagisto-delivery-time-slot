<?php

namespace Webkul\DeliveryTimeSlot\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class DeliveryTimeSlotServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        include __DIR__ . '/../Http/front-routes.php';

        include __DIR__ . '/../Http/admin-routes.php';

        $this->app->register(ModuleServiceProvider::class);

        $this->app->register(EventServiceProvider::class);

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'delivery-time-slot');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'delivery-time-slot');

        /*** Default Theme page override ***/
        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/checkout/onepage.blade.php' => resource_path('themes/default/views/checkout/onepage.blade.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/checkout/onepage/review.blade.php' => resource_path('themes/default/views/checkout/onepage/review.blade.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/checkout/onepage/shipping.blade.php' => resource_path('themes/default/views/checkout/onepage/shipping.blade.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/customers/account/orders' => resource_path('themes/default/views/customers/account/orders'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/default/emails/sales/' => resource_path('themes/default/views/emails/sales'),
        ]);

        /*** Velocity Theme page override ***/
        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/checkout/onepage.blade.php' => resource_path('themes/velocity/views/checkout/onepage.blade.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/checkout/onepage/review.blade.php' => resource_path('themes/velocity/views/checkout/onepage/review.blade.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/checkout/onepage/shipping.blade.php' => resource_path('themes/velocity/views/checkout/onepage/shipping.blade.php'),
        ]);

	    $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/customers/account/orders/' => resource_path('themes/velocity/views/customers/account/orders'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/shop/velocity/emails/sales/' => resource_path('themes/velocity/views/emails/sales'),
        ]);

        /*** Admin page override ***/
        $this->publishes([
            __DIR__ . '/../Resources/views/admin/sales' => resource_path('views/vendor/admin/sales'),
        ]);

        $this->publishes([
            __DIR__ . '/../Resources/views/emails/' => resource_path('views/vendor/emails/'),
        ]);

        /*** Assets of themes override ***/
        // $this->publishes([
        //     __DIR__ . '/../../publishable/assets' => public_path('themes/default/assets'),
        // ], 'public');

        // $this->publishes([
        //     __DIR__ . '/../../publishable/assets/' => public_path('themes/velocity/assets'),
        // ], 'public');

        $this->overrideModels();

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'delivery_time_slot');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php', 'menu.admin'
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
