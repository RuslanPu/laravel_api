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
        Schema::table('package_services_api_services', static function (Blueprint $table) {
            $table->integer('quantity')->after('service_id')->nullable();
            $table->longText('comments')->after('quantity')->nullable();
            $table->string('username')->after('comments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_services_api_services', function (Blueprint $table) {
            $table->dropColumn('comments');
            $table->dropColumn('quantity');
            $table->dropColumn('username');
        });
    }
};
