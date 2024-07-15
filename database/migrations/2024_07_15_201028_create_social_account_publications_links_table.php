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
        Schema::create('social_account_publications_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('social_account_id')
                ->constrained('social_accounts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_package_id')
                ->constrained('user_packages')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('publication_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_account_publications_links');
    }
};
