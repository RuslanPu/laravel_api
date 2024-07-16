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
        Schema::table('nakrutka_orders', function (Blueprint $table) {
            $table->dropForeign(['user_package_id']);
            $table->dropColumn('user_package_id');

            $table->foreignId('package_id')
                ->after('user_id')
                ->constrained('package_services')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nakrutka_orders', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropColumn('package_id');

            $table->foreignId('user_package_id')
                ->constrained('user_packages')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }
};
