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
            $table->string('delivery_day')->after('delivery_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_time_slots_orders', function (Blueprint $table) {
            $table->dropIfExists('delivery_day');
        });
    }
};
