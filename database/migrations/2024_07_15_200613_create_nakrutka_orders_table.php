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
        Schema::create('nakrutka_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_package_id')
                ->constrained('user_packages')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('service')
                ->constrained('api_services')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('order')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('link')->nullable();
            $table->float('charge')->nullable();
            $table->integer('remains')->nullable();
            $table->string('status')->nullable();
            $table->integer('start_count')->nullable();
            $table->string('cancel_info')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nakrutka_orders');
    }
};
