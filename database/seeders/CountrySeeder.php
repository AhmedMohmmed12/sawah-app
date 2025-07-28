<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'name' => 'Italy',
                'code' => 'IT',
                'currency' => 'EUR',
                'exchange_rate_to_sar' => 4.10,
                'climate' => 'Mild',
                'daily_budget_min' => 100,
                'daily_budget_max' => 300,
                'image' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=800&h=600&fit=crop',
                'description' => 'Italy is known for its rich history, art, and cuisine.'
            ],
            [
                'name' => 'France',
                'code' => 'FR',
                'currency' => 'EUR',
                'exchange_rate_to_sar' => 4.10,
                'climate' => 'Mild',
                'daily_budget_min' => 120,
                'daily_budget_max' => 350,
                'image' => 'https://images.unsplash.com/photo-1511739001486-6bfe10ce785f?w=800&h=600&fit=crop',
                'description' => 'France offers romance, culture, and world-class cuisine.'
            ],
            [
                'name' => 'Japan',
                'code' => 'JP',
                'currency' => 'JPY',
                'exchange_rate_to_sar' => 0.025,
                'climate' => 'Mild',
                'daily_budget_min' => 150,
                'daily_budget_max' => 400,
                'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&h=600&fit=crop',
                'description' => 'Japan blends ancient traditions with cutting-edge technology.'
            ],
            [
                'name' => 'Thailand',
                'code' => 'TH',
                'currency' => 'THB',
                'exchange_rate_to_sar' => 0.11,
                'climate' => 'Warm',
                'daily_budget_min' => 50,
                'daily_budget_max' => 150,
                'image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800&h=600&fit=crop',
                'description' => 'Thailand offers tropical beaches, temples, and delicious street food.'
            ],
            [
                'name' => 'Spain',
                'code' => 'ES',
                'currency' => 'EUR',
                'exchange_rate_to_sar' => 4.10,
                'climate' => 'Warm',
                'daily_budget_min' => 80,
                'daily_budget_max' => 250,
                'image' => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=800&h=600&fit=crop',
                'description' => 'Spain offers vibrant culture, beautiful beaches, and delicious tapas.'
            ],
            [
                'name' => 'Singapore',
                'code' => 'SG',
                'currency' => 'SGD',
                'exchange_rate_to_sar' => 2.75,
                'climate' => 'Warm',
                'daily_budget_min' => 200,
                'daily_budget_max' => 500,
                'image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?w=800&h=600&fit=crop',
                'description' => 'Singapore is a modern city-state with diverse culture and world-class attractions.'
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['code']], // Check for existing country by code
                $country
            );
        }
    }
}