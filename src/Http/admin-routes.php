<?php

Route::group(['middleware' => ['web']], function () {

    Route::prefix('admin')->group(function () {

        Route::group(['middleware' => ['admin']], function () {

            Route::prefix('delivery_time_slot')->group(function () {
                //show index page
                Route::get('/default-slot', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\TimeSlotController@index')->defaults('_config', [
                    'view' => 'delivery-time-slot::admin.configuration.index'
                ])->name('admin.timeslot.index');

                Route::post('/default-slot', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\TimeSlotController@store')->defaults('_config', [
                    'redirect' => 'marketplace.timeslot.admin.index'
                ])->name('timeslot.admin.saveconfig');
                
                //seller orders delivery
                Route::get('/orders', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\TimeSlotController@deliveryOrders')->defaults('_config', [
                    'view' => 'delivery-time-slot::admin.marketplace.timeslots.delivery-orders'
                ])->name('admin.timeslot.delivery.orders');

                //seller delivery timeslots
                Route::get('/timeslots', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\TimeSlotController@deliverySlots')->defaults('_config', [
                    'view' => 'delivery-time-slot::admin.marketplace.timeslots.delivery-time-slots'
                ])->name('admin.timeslot.delivery.timeslots');
            });
            
            // Sales Routes
            Route::prefix('sales')->group(function () {
                //admin order view
                Route::get('/orders/view/{id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\OrderController@view')->defaults('_config', [
                    'view' => 'admin::sales.orders.view'
                ])->name('admin.sales.orders.view');
                
                // Sales Invoices Routes
                Route::get('/invoices/create/{order_id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\InvoiceController@create')->defaults('_config', [
                    'view' => 'admin::sales.invoices.create'
                ])->name('admin.sales.invoices.create');

                Route::get('/invoices/view/{id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\InvoiceController@view')->defaults('_config', [
                    'view' => 'admin::sales.invoices.view'
                ])->name('admin.sales.invoices.view');

                Route::get('/invoices/print/{id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\InvoiceController@print')->defaults('_config', [
                    'view' => 'admin::sales.invoices.print',
                ])->name('admin.sales.invoices.print');

                // Sales Shipments Routes
                Route::get('/shipments/create/{order_id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\ShipmentController@create')->defaults('_config', [
                    'view' => 'admin::sales.shipments.create'
                ])->name('admin.sales.shipments.create');

                Route::get('/shipments/view/{id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\ShipmentController@view')->defaults('_config', [
                    'view' => 'admin::sales.shipments.view'
                ])->name('admin.sales.shipments.view');

                // Sales Redunds Routes
                Route::get('/refunds/create/{order_id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\RefundController@create')->defaults('_config', [
                    'view' => 'admin::sales.refunds.create',
                ])->name('admin.sales.refunds.create');

                Route::get('/refunds/view/{id}', 'Webkul\DeliveryTimeSlot\Http\Controllers\Admin\Sales\RefundController@view')->defaults('_config', [
                    'view' => 'admin::sales.refunds.view',
                ])->name('admin.sales.refunds.view');

            });
        });
    });
});
