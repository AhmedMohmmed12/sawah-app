<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Country;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $hotels = [
            // Italy Hotels
            [
                'country_name' => 'Italy',
                'name' => 'Hotel Hassler Roma',
                'stars' => 5,
                'price_per_night' => 800,
                'description' => 'Luxury hotel overlooking the Spanish Steps, offering stunning views of Rome.',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Italy',
                'name' => 'Hotel Danieli',
                'stars' => 5,
                'price_per_night' => 600,
                'description' => 'Historic luxury hotel in Venice with Gothic architecture and canal views.',
                'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Italy',
                'name' => 'Grand Hotel Tremezzo',
                'stars' => 5,
                'price_per_night' => 700,
                'description' => 'Lake Como luxury hotel with private beach and stunning mountain views.',
                'image' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop'
            ],

            // France Hotels
            [
                'country_name' => 'France',
                'name' => 'The Ritz Paris',
                'stars' => 5,
                'price_per_night' => 1200,
                'description' => 'Iconic luxury hotel in Place Vendôme, known for its elegance and history.',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'France',
                'name' => 'Hôtel de Crillon',
                'stars' => 5,
                'price_per_night' => 1000,
                'description' => 'Historic palace hotel on Place de la Concorde with Michelin-starred dining.',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'France',
                'name' => 'Le Bristol Paris',
                'stars' => 5,
                'price_per_night' => 900,
                'description' => 'Elegant hotel with rooftop pool and three Michelin-starred restaurant.',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
            ],

            // Japan Hotels
            [
                'country_name' => 'Japan',
                'name' => 'Aman Tokyo',
                'stars' => 5,
                'price_per_night' => 1500,
                'description' => 'Ultra-luxury hotel with minimalist design and stunning city views.',
                'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Japan',
                'name' => 'Park Hyatt Tokyo',
                'stars' => 5,
                'price_per_night' => 800,
                'description' => 'Famous for its role in Lost in Translation, with amazing city views.',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Japan',
                'name' => 'Hoshinoya Kyoto',
                'stars' => 5,
                'price_per_night' => 1000,
                'description' => 'Traditional ryokan-style luxury hotel on the banks of the Oi River.',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
            ],

            // Thailand Hotels
            [
                'country_name' => 'Thailand',
                'name' => 'The Peninsula Bangkok',
                'stars' => 5,
                'price_per_night' => 400,
                'description' => 'Riverside luxury hotel with stunning views of the Chao Phraya River.',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Thailand',
                'name' => 'Mandarin Oriental Bangkok',
                'stars' => 5,
                'price_per_night' => 500,
                'description' => 'Historic luxury hotel with traditional Thai architecture and spa.',
                'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Thailand',
                'name' => 'Banyan Tree Phuket',
                'stars' => 5,
                'price_per_night' => 350,
                'description' => 'Beachfront resort with private pool villas and spa treatments.',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&h=600&fit=crop'
            ],

            // Spain Hotels
            [
                'country_name' => 'Spain',
                'name' => 'Hotel Arts Barcelona',
                'stars' => 5,
                'price_per_night' => 600,
                'description' => 'Modern luxury hotel with beach access and stunning Mediterranean views.',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Spain',
                'name' => 'Mandarin Oriental Ritz Madrid',
                'stars' => 5,
                'price_per_night' => 700,
                'description' => 'Historic palace hotel in the heart of Madrid with royal heritage.',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Spain',
                'name' => 'Parador de Granada',
                'stars' => 4,
                'price_per_night' => 300,
                'description' => 'Unique hotel within the Alhambra complex with historic charm.',
                'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&h=600&fit=crop'
            ],

            // Singapore Hotels
            [
                'country_name' => 'Singapore',
                'name' => 'Marina Bay Sands',
                'stars' => 5,
                'price_per_night' => 800,
                'description' => 'Iconic hotel with rooftop infinity pool and stunning city skyline views.',
                'image' => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Singapore',
                'name' => 'Raffles Hotel Singapore',
                'stars' => 5,
                'price_per_night' => 1000,
                'description' => 'Historic colonial hotel known for the Singapore Sling cocktail.',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop'
            ],
            [
                'country_name' => 'Singapore',
                'name' => 'The Fullerton Bay Hotel',
                'stars' => 5,
                'price_per_night' => 600,
                'description' => 'Luxury waterfront hotel with stunning Marina Bay views.',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&h=600&fit=crop'
            ],
        ];

        foreach ($hotels as $hotel) {
            $country = Country::where('name', $hotel['country_name'])->first();
            if ($country) {
                Hotel::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'name' => $hotel['name']
                    ],
                    [
                        'stars' => $hotel['stars'],
                        'price_per_night' => $hotel['price_per_night'],
                        'description' => $hotel['description'],
                        'image' => $hotel['image'],
                    ]
                );
            }
        }
    }
}