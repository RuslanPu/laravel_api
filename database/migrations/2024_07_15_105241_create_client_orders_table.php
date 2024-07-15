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
        Schema::create('client_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_package_id')
                ->constrained('user_packages')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('api_service_id')
                ->constrained('api_services')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('order')->nullable();
            $table->integer('charge')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_orders');
    }
};
