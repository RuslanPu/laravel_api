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
        Schema::create('api_services', function (Blueprint $table) {
            $table->id();
            $table->string('id_service');
            $table->string('name');
            $table->string('type');
            $table->string('refill')->nullable();
            $table->string('category');
            $table->string('rate');
            $table->string('min');
            $table->string('max');
            $table->string('drops')->nullable();
            $table->string('speed_per_hour');
            $table->string('max_done_count_day');
            $table->string('limit')->nullable();
            $table->string('queue_time_minutes');
            $table->string('cancel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_services');
    }
};
