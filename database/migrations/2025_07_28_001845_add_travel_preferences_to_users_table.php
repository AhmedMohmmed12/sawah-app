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
        Schema::table('users', function (Blueprint $table) {
            $table->string('preferred_climate')->nullable();
            $table->string('budget_range')->nullable();
            $table->json('travel_interests')->nullable();
            $table->integer('search_count')->default(0);
            $table->integer('favorites_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'preferred_climate',
                'budget_range',
                'travel_interests',
                'search_count',
                'favorites_count'
            ]);
        });
    }
};
