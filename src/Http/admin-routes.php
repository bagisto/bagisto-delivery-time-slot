<?php

use Illuminate\Support\Facades\Route;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\TimeSlotController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\OrderController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\RefundController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\InvoiceController;
use Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\ShipmentController;

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin'], function () {

    Route::prefix('delivery_time_slot')->group(function () {

        Route::controller(TimeSlotController::class)->group(function () {

            Route::get('/default-slot', 'index')->defaults('_config', [
                'view' => 'delivery-time-slot::admin.configuration.index'
            ])->name('admin.timeslot.index');
    
            Route::post('/default-slot', 'store')->defaults('_config', [
                'redirect' => 'marketplace.timeslot.admin.index'
            ])->name('timeslot.admin.saveconfig');
            
            Route::get('/orders', 'deliveryOrders')->defaults('_config', [
                'view' => 'delivery-time-slot::admin.marketplace.timeslots.delivery-orders'
            ])->name('admin.timeslot.delivery.orders');

            Route::get('/timeslots', 'deliverySlots')->defaults('_config', [
                'view' => 'delivery-time-slot::admin.marketplace.timeslots.delivery-time-slots'
            ])->name('admin.timeslot.delivery.timeslots');

        });

    });
    
    Route::prefix('sales')->group(function () {

        Route::get('/orders/view/{id}', [OrderController::class, 'view'])->defaults('_config', [
            'view' => 'admin::sales.orders.view'
        ])->name('admin.sales.orders.view');

        Route::controller(InvoiceController::class)->group(function () {            
            
            Route::get('/invoices/create/{order_id}', 'create')->defaults('_config', [
                'view' => 'admin::sales.invoices.create'
            ])->name('admin.sales.invoices.create');

            Route::get('/invoices/view/{id}', 'view')->defaults('_config', [
                'view' => 'admin::sales.invoices.view'
            ])->name('admin.sales.invoices.view');

            Route::get('/invoices/print/{id}', 'print')->defaults('_config', [
                'view' => 'admin::sales.invoices.print',
            ])->name('admin.sales.invoices.print');

        });

        Route::controller(ShipmentController::class)->group(function () {   

            Route::get('/shipments/create/{order_id}', 'create')->defaults('_config', [
                'view' => 'admin::sales.shipments.create'
            ])->name('admin.sales.shipments.create');

            Route::get('/shipments/view/{id}', 'view')->defaults('_config', [
                'view' => 'admin::sales.shipments.view'
            ])->name('admin.sales.shipments.view');

        });

        Route::controller(RefundController::class)->group(function () {

            Route::get('/refunds/create/{order_id}', 'create')->defaults('_config', [
                'view' => 'admin::sales.refunds.create',
            ])->name('admin.sales.refunds.create');

            Route::get('/refunds/view/{id}', 'view')->defaults('_config', [
                'view' => 'admin::sales.refunds.view',
            ])->name('admin.sales.refunds.view');

        });

    });

});
