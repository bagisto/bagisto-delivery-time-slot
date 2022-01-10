<?php

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency']], function () {

    //Marketplace routes starts here
    Route::prefix('marketplace')->group(function () {

        //mindex pages
        Route::get('/account/timedelivery/configuration', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Seller\SellerTimeSlotController@index')->defaults('_config', [
            'view' => 'delivery-time-slot::shop.sellers.account.time-slot-configuration'
        ])->name('marketplace.timeslot.seller.index');

        //store seller end time slots
        Route::post('/account/timedelivery/store', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Seller\SellerTimeSlotController@store')->defaults('_config', [
            'redirect' => 'marketplace.timeslot.seller.index'
        ])->name('marketplace.timeslot.seller.saveconfig');

        //view the order of customer
        Route::get('/account/timedelivery/orders', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Seller\SellerTimeSlotController@index')->defaults('_config', [
            'view' => 'delivery-time-slot::shop.sellers.account.sales.orders.delivery-order-history'
        ])->name('marketplace.timeslot.seller.orders');

        //checkout routes
        //Checkout Save Address Form Store
        Route::post('/checkout/save-address', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\OnepageController@saveAddress')->name('marketplace.timeslot.checkout.saveaddress');

        //save shipping
        Route::post('/checkout/save-order', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\OnepageController@saveOrder')->name('marketplace.timeslot.checkout.save-order');

        //save shipping
        Route::post('/checkout/save-payment', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\OnepageController@savePayment')->name('marketplace.timeslot.checkout.save-payment');

        //seller order view
        Route::get('orders/view/{id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Seller\SellerTimeSlotController@view')->defaults('_config', [
            'view' => 'marketplace::shop.sellers.account.sales.orders.view'
        ])->name('marketplace.timeslot.seller.account.orders.view');

    });

    Route::get('account/orders/view/{id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\Account\Customer\OrderController@view')->defaults('_config', [
        'view' => 'shop::customers.account.orders.view'
    ])->name('timeslot.customer.orders.view');

    Route::prefix('paypal/standard')->group(function () {
        //paypal routes
        Route::get('/success', 'Webkul\DeliveryTimeSlot\Http\Controllers\Shop\StandardController@success')->name('paypal.standard.success');
    });
});