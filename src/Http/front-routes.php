<?php

use Illuminate\Support\Facades\Route;
use Webkul\DeliveryTimeSlot\Http\Controllers\Shop\OnepageController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Shop\StandardController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Customer\OrderController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Seller\SellerTimeSlotController;

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency']], function () {

    Route::prefix('marketplace')->group(function () {

        Route::controller(SellerTimeSlotController::class)->group(function () {

            Route::get('/account/timedelivery/configuration', 'index')->defaults('_config', [
                'view' => 'delivery-time-slot::shop.sellers.account.time-slot-configuration'
            ])->name('marketplace.timeslot.seller.index');

            Route::post('/account/timedelivery/store', 'store')->defaults('_config', [
                'redirect' => 'marketplace.timeslot.seller.index'
            ])->name('marketplace.timeslot.seller.saveconfig');

            Route::get('/account/timedelivery/orders', 'index')->defaults('_config', [
                'view' => 'delivery-time-slot::shop.sellers.account.sales.orders.delivery-order-history'
            ])->name('marketplace.timeslot.seller.orders');

        });

        Route::controller(OnepageController::class)->group(function () {

            Route::post('/checkout/save-address', 'saveAddress')->name('marketplace.timeslot.checkout.saveaddress');

            Route::post('/checkout/save-order', 'saveOrder')->name('marketplace.timeslot.checkout.save-order');

            Route::post('/checkout/save-payment', 'savePayment')->name('marketplace.timeslot.checkout.save-payment');

        });

        Route::get('orders/view/{id}', [SellerTimeSlotController::class, 'view'])->defaults('_config', [
            'view' => 'marketplace::shop.sellers.account.sales.orders.view'
        ])->name('marketplace.timeslot.seller.account.orders.view');

    });

    Route::get('account/orders/view/{id}', [OrderController::class, 'view'])->defaults('_config', [
        'view' => 'shop::customers.account.orders.view'
    ])->name('timeslot.customer.orders.view');

    Route::prefix('paypal/standard')->group(function () {
        Route::get('/success', [StandardController::class, 'success'])->name('paypal.standard.success');
    });
});