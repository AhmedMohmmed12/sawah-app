<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
{
    /**
     * Riyals per unit, used until `php artisan rates:update` fetches live
     * rates (it runs automatically once a day).
     */
    private const FALLBACK_RATES = [
        'EUR' => 4.35, 'GBP' => 5.02, 'CHF' => 4.66, 'JPY' => 0.0251, 'THB' => 0.115,
        'SGD' => 2.90, 'TRY' => 0.090, 'AED' => 1.021, 'EGP' => 0.077, 'JOD' => 5.29,
        'MAD' => 0.405, 'GEL' => 1.38, 'AZN' => 2.21, 'BAM' => 2.22, 'MYR' => 0.885,
        'IDR' => 0.00023, 'MVR' => 0.243, 'KRW' => 0.0027,
    ];

    public function run(): void
    {
        $data = require __DIR__.'/data/destinations.php';
        $credits = require __DIR__.'/data/image-credits.php';

        foreach ($data as $row) {
            $slug = Str::slug($row['name']);
            $key = "countries/{$slug}";
            $existing = Country::where('name', $row['name'])->first();

            Country::updateOrCreate(['name' => $row['name']], [
                'slug' => $slug,
                'code' => $row['code'],
                'capital' => $row['capital'],
                'region' => $row['region'],
                'currency' => $row['currency'],
                'exchange_rate_to_sar' => $existing?->exchange_rate_to_sar ?: self::FALLBACK_RATES[$row['currency']],
                'climate' => $row['climate'],
                'best_months' => $row['best_months'],
                'daily_budget_min' => $row['budget'][0],
                'daily_budget_max' => $row['budget'][1],
                'description' => $row['description'],
                'image' => isset($credits[$key]) ? "images/{$key}.jpg" : null,
                'image_caption' => $row['caption'],
                'image_credit' => $credits[$key]['credit'] ?? null,
            ]);
        }
    }
}
