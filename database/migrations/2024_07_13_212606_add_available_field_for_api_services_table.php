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
        Schema::table('api_services', static function (Blueprint $table) {
            $table->boolean('available')
                ->default(true)
                ->after('cancel')
                ->comment('Service availability');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('api_services', static function (Blueprint $table) {
            $table->dropColumn('available');
        });
    }
};
