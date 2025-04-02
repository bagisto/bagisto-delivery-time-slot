<?php

use Illuminate\Support\Facades\Route;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\TimeSlotController;

Route::group(['middleware' => ['admin']], function () {
    Route::controller(TimeSlotController::class)->prefix('admin')->group(function () {          
        Route::get('/time-slot', 'index')->name('admin.timeslot.index');

        Route::post('/time-slot', 'store')->name('admin.time-slot.store');

        Route::post('/delete', 'deleteSlots')->name('admin.time-slot.delete');

        Route::post('/mass-delete', 'massDelete')->name('admin.time-slot.mass-delete');
                
        Route::get('/time-delivery/orders', 'deliveryOrders')->name('admin.timeslot.delivery.orders');
    });
});
