<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $data = require __DIR__.'/data/destinations.php';
        $credits = require __DIR__.'/data/image-credits.php';

        foreach ($data as $row) {
            $country = Country::where('name', $row['name'])->firstOrFail();
            $names = [];

            foreach ($row['hotels'] as $item) {
                $key = 'hotels/'.Str::slug($item['name']);
                $names[] = $item['name'];

                Hotel::updateOrCreate(
                    ['country_id' => $country->id, 'name' => $item['name']],
                    [
                        'city' => $item['city'],
                        'stars' => $item['stars'],
                        'price_per_night' => $item['price'],
                        'description' => $item['description'],
                        'image' => isset($credits[$key]) ? "images/{$key}.jpg" : null,
                        'image_credit' => AttractionSeeder::credit($credits[$key] ?? null, $item['pictured'] ?? null),
                    ]
                );
            }

            Hotel::where('country_id', $country->id)
                ->whereNotIn('name', $names)
                ->where('image', 'like', 'https://images.unsplash.com/%')
                ->delete();
        }
    }
}
