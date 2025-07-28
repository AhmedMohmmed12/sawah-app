<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attraction;
use App\Models\Country;

class AttractionSeeder extends Seeder
{
    public function run()
    {
        $attractions = [
            // Italy Attractions
            [
                'country_name' => 'Italy',
                'name' => 'Colosseum',
                'description' => 'Ancient amphitheater and iconic symbol of Rome, built in 70-80 AD.',
                'image' => 'https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Italy',
                'name' => 'Leaning Tower of Pisa',
                'description' => 'Famous bell tower known for its unintended tilt, located in Pisa.',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Italy',
                'name' => 'Vatican City',
                'description' => 'Smallest independent state in the world, home to St. Peter\'s Basilica.',
                'image' => 'https://images.unsplash.com/photo-1555992336-03a23c7b20ee?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],

            // France Attractions
            [
                'country_name' => 'France',
                'name' => 'Eiffel Tower',
                'description' => 'Iconic iron lattice tower on the Champ de Mars in Paris.',
                'image' => 'https://images.unsplash.com/photo-1511739001486-6bfe10ce785f?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'France',
                'name' => 'Louvre Museum',
                'description' => 'World\'s largest art museum, home to the Mona Lisa.',
                'image' => 'https://images.unsplash.com/photo-1565967511849-76a60a516170?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'France',
                'name' => 'Palace of Versailles',
                'description' => 'Former royal residence with stunning gardens and architecture.',
                'image' => 'https://images.unsplash.com/photo-1589308078059-be1415eab4c3?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],

            // Japan Attractions
            [
                'country_name' => 'Japan',
                'name' => 'Mount Fuji',
                'description' => 'Japan\'s highest mountain and sacred symbol, perfect for hiking.',
                'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=800&h=600&fit=crop',
                'type' => 'Nature'
            ],
            [
                'country_name' => 'Japan',
                'name' => 'Senso-ji Temple',
                'description' => 'Tokyo\'s oldest temple, located in Asakusa district.',
                'image' => 'https://images.unsplash.com/photo-1545569341-9eb8b30979d9?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Japan',
                'name' => 'Fushimi Inari Shrine',
                'description' => 'Famous for its thousands of torii gates in Kyoto.',
                'image' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],

            // Thailand Attractions
            [
                'country_name' => 'Thailand',
                'name' => 'Grand Palace',
                'description' => 'Complex of buildings in Bangkok, former royal residence.',
                'image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Thailand',
                'name' => 'Wat Phra Kaew',
                'description' => 'Temple of the Emerald Buddha, most sacred Buddhist temple.',
                'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Thailand',
                'name' => 'Phi Phi Islands',
                'description' => 'Stunning islands with crystal clear waters and white sand beaches.',
                'image' => 'https://images.unsplash.com/photo-1528127269322-539801943592?w=800&h=600&fit=crop',
                'type' => 'Nature'
            ],

            // Spain Attractions
            [
                'country_name' => 'Spain',
                'name' => 'Sagrada Familia',
                'description' => 'Antoni Gaudí\'s masterpiece, stunning basilica in Barcelona.',
                'image' => 'https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Spain',
                'name' => 'Alhambra Palace',
                'description' => 'Stunning Moorish palace and fortress complex in Granada.',
                'image' => 'https://images.unsplash.com/photo-1589308078059-be1415eab4c3?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Spain',
                'name' => 'Park Güell',
                'description' => 'Gaudí\'s colorful public park with unique architecture.',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],

            // Singapore Attractions
            [
                'country_name' => 'Singapore',
                'name' => 'Marina Bay Sands',
                'description' => 'Iconic hotel with rooftop infinity pool and stunning city views.',
                'image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?w=800&h=600&fit=crop',
                'type' => 'Cultural'
            ],
            [
                'country_name' => 'Singapore',
                'name' => 'Gardens by the Bay',
                'description' => 'Spectacular nature park with Supertree Grove and Cloud Forest.',
                'image' => 'https://images.unsplash.com/photo-1565967511849-76a60a516170?w=800&h=600&fit=crop',
                'type' => 'Nature'
            ],
            [
                'country_name' => 'Singapore',
                'name' => 'Sentosa Island',
                'description' => 'Entertainment island with beaches, Universal Studios, and attractions.',
                'image' => 'https://images.unsplash.com/photo-1528127269322-539801943592?w=800&h=600&fit=crop',
                'type' => 'Adventure'
            ],
        ];

        foreach ($attractions as $attraction) {
            $country = Country::where('name', $attraction['country_name'])->first();
            if ($country) {
                Attraction::updateOrCreate(
                    [
                        'country_id' => $country->id,
                        'name' => $attraction['name']
                    ],
                    [
                        'description' => $attraction['description'],
                        'image' => $attraction['image'],
                        'type' => $attraction['type'],
                    ]
                );
            }
        }
    }
}