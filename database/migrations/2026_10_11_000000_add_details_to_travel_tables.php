<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
            $table->string('capital')->nullable()->after('code');
            $table->string('region')->nullable()->after('capital');
            $table->string('best_months')->nullable()->after('climate');
            $table->string('image_caption')->nullable()->after('image');
            $table->string('image_credit')->nullable()->after('image_caption');
            // Four decimals rounds currencies like IDR (0.00023 SAR) badly.
            $table->decimal('exchange_rate_to_sar', 16, 8)->change();
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->string('city')->nullable()->after('name');
            $table->string('image_credit')->nullable()->after('image');
        });

        Schema::table('attractions', function (Blueprint $table) {
            $table->string('city')->nullable()->after('name');
            $table->string('image_credit')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'capital', 'region', 'best_months', 'image_caption', 'image_credit']);
            $table->decimal('exchange_rate_to_sar', 8, 4)->change();
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn(['city', 'image_credit']);
        });

        Schema::table('attractions', function (Blueprint $table) {
            $table->dropColumn(['city', 'image_credit']);
        });
    }
};
