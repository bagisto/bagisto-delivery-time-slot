<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('delivery_time_slots_orders', function (Blueprint $table) {
            $table->foreign('time_slot_id')->references('id')->on('delivery_time_slots')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_time_slots_orders', function (Blueprint $table) {
            $table->dropForeign(['time_slot_id']);
        });
    }
};
