<?php

use Illuminate\Support\Facades\Route;

use Webkul\DeliveryTimeSlot\Http\Controllers\Shop\API\OnepageController;

Route::group(['middleware' => ['locale', 'theme', 'currency'], 'prefix' => 'api'], function () { 
    Route::controller(OnepageController::class)->prefix('checkout/onepage')->group(function () {
        Route::post('delivery-time-slot', 'storeDeliveryTime')->name('shop.checkout.onepage.delivery_time_Slot.store');
    });
});