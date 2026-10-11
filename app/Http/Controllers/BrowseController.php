<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function hotels(Request $request)
    {
        $filters = $request->validate([
            'country' => 'nullable|string|exists:countries,slug',
            'stars' => 'nullable|integer|between:1,5',
            'max_price' => 'nullable|integer|min:0',
            'sort' => 'nullable|in:price,price_desc,name',
        ]);

        $hotels = Hotel::with('country')
            ->when($filters['country'] ?? null, fn ($q, $slug) => $q->whereHas('country', fn ($c) => $c->where('slug', $slug)))
            ->when($filters['stars'] ?? null, fn ($q, $v) => $q->where('stars', '>=', $v))
            ->when($filters['max_price'] ?? null, fn ($q, $v) => $q->where('price_per_night', '<=', $v))
            ->when(($filters['sort'] ?? 'price') === 'price_desc', fn ($q) => $q->orderByDesc('price_per_night'))
            ->when(($filters['sort'] ?? 'price') === 'name', fn ($q) => $q->orderBy('name'))
            ->orderBy('price_per_night')
            ->paginate(24)
            ->withQueryString();

        return view('browse.hotels', [
            'hotels' => $hotels,
            'filters' => $filters,
            'countries' => Country::orderBy('name')->get(['name', 'slug']),
        ]);
    }

    public function attractions(Request $request)
    {
        $filters = $request->validate([
            'country' => 'nullable|string|exists:countries,slug',
            'type' => 'nullable|in:'.implode(',', Attraction::TYPES),
        ]);

        $attractions = Attraction::with('country')
            ->when($filters['country'] ?? null, fn ($q, $slug) => $q->whereHas('country', fn ($c) => $c->where('slug', $slug)))
            ->when($filters['type'] ?? null, fn ($q, $v) => $q->where('type', $v))
            ->orderBy('name')
            ->paginate(24)
            ->withQueryString();

        return view('browse.attractions', [
            'attractions' => $attractions,
            'filters' => $filters,
            'countries' => Country::orderBy('name')->get(['name', 'slug']),
            'types' => Attraction::TYPES,
        ]);
    }

    public function credits()
    {
        $credits = require database_path('seeders/data/image-credits.php');

        $rows = collect()
            ->concat(Country::whereNotNull('image_credit')->orderBy('name')->get()->map(fn ($c) => ['Destination', $c->name, $c->image_caption, $c->image_credit, $c->image]))
            ->concat(Attraction::with('country')->whereNotNull('image_credit')->orderBy('name')->get()->map(fn ($a) => ['Things to do', $a->name, $a->country->name, $a->image_credit, $a->image]))
            ->concat(Hotel::with('country')->whereNotNull('image_credit')->orderBy('name')->get()->map(fn ($h) => ['Hotel', $h->name, $h->country->name, $h->image_credit, $h->image]))
            ->map(function ($row) use ($credits) {
                $key = preg_replace('#^images/|\.jpg$#', '', (string) $row[4]);

                return [
                    'section' => $row[0],
                    'name' => $row[1],
                    'where' => $row[2],
                    'credit' => $row[3],
                    'source' => $credits[$key]['source'] ?? null,
                ];
            });

        return view('credits', ['rows' => $rows]);
    }
}
