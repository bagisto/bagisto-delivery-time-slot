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
            $table->dropForeign(['time_slot_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_time_slots', function (Blueprint $table) {
            $table->dropIfExists('time_slot_id');
        });
    }
};
