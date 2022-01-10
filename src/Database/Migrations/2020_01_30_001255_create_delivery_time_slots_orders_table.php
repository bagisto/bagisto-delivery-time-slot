<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTimeSlotsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_time_slots_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('time_slot_id')->nullable()->unsigned();
            $table->foreign('time_slot_id')->references('id')->on('delivery_time_slots')->onDelete('cascade');
            $table->string('delivery_date')->nullable();

            $table->integer('customer_id')->nullable()->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->integer('order_id')->nullable()->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_time_slots_orders');
    }
}
