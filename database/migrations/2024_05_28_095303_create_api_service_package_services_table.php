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
        Schema::create('api_service_package_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('service_id');
            $table->string('quantity');
            $table->timestamps();

            $table->foreign('package_id', 'fk_package_service_package_idx')->references('id')->on('package_services')->onDelete('cascade');
            $table->foreign('service_id', 'fk_package_service_service_idx')->references('id')->on('api_services')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('api_service_package_services', function (Blueprint $table) {
           $table->dropForeign('fk_package_service_package_idx');
           $table->dropColumn('package_id');

            $table->dropForeign('fk_package_service_service_idx');
            $table->dropColumn('service_id');
        });

        Schema::dropIfExists('api_service_package_services');
    }
};
