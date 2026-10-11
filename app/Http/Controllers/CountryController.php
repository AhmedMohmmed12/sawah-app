<?php

namespace App\Http\Controllers;

use App\Models\Country;

class CountryController extends Controller
{
    public function show(string $slug)
    {
        $country = Country::with([
            'attractions' => fn ($q) => $q->orderBy('id'),
            'hotels' => fn ($q) => $q->orderBy('price_per_night'),
        ])->where('slug', $slug)->firstOrFail();

        $similar = Country::where('id', '!=', $country->id)
            ->orderByRaw('ABS(daily_budget_min - ?)', [$country->daily_budget_min])
            ->take(4)
            ->get();

        return view('country.show', compact('country', 'similar'));
    }
}
