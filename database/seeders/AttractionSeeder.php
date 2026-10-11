<?php

namespace Database\Seeders;

use App\Models\Attraction;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttractionSeeder extends Seeder
{
    public function run(): void
    {
        $data = require __DIR__.'/data/destinations.php';
        $credits = require __DIR__.'/data/image-credits.php';

        foreach ($data as $row) {
            $country = Country::where('name', $row['name'])->firstOrFail();
            $names = [];

            foreach ($row['attractions'] as $item) {
                $key = 'attractions/'.Str::slug($item['name']);
                $names[] = $item['name'];

                Attraction::updateOrCreate(
                    ['country_id' => $country->id, 'name' => $item['name']],
                    [
                        'city' => $item['city'],
                        'type' => $item['type'],
                        'description' => $item['description'],
                        'image' => isset($credits[$key]) ? "images/{$key}.jpg" : null,
                        'image_credit' => self::credit($credits[$key] ?? null, $item['pictured'] ?? null),
                    ]
                );
            }

            // Remove the old placeholder rows (they all used Unsplash links);
            // anything added through the admin panel is left alone.
            Attraction::where('country_id', $country->id)
                ->whereNotIn('name', $names)
                ->where('image', 'like', 'https://images.unsplash.com/%')
                ->delete();
        }
    }

    public static function credit(?array $credit, ?string $pictured): ?string
    {
        if (! $credit) {
            return null;
        }

        return ($pictured ? "Pictured: {$pictured} · " : '').$credit['credit'];
    }
}
