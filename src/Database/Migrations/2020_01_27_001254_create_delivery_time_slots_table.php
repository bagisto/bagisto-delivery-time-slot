<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_time_slots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('delivery_day')->nullable();
            $table->text('start_time')->nullable();
            $table->text('end_time')->nullable();
            $table->integer('time_delivery_quota')->nullable();
            $table->integer('is_seller')->default(0);
            $table->integer('minimum_time_required')->default(1);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('delivery_time_slots');
    }
}
