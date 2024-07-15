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
        Schema::table('api_services', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('api_services', function (Blueprint $table) {
            $table->foreignId('category')
                ->after('type')
                ->constrained('api_service_categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('api_services', function (Blueprint $table) {
            $table->dropForeign(['category']);
            $table->dropColumn('category');

            $table->string('category')
                ->after('type');
        });
    }
};
