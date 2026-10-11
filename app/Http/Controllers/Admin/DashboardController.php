<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\User;
use App\Services\ExchangeRates;

class DashboardController extends Controller
{
    public function index(ExchangeRates $rates)
    {
        $stats = [
            'countries' => Country::count(),
            'hotels' => Hotel::count(),
            'attractions' => Attraction::count(),
            'users' => User::where('role', 'user')->count(),
        ];

        // Things that would look unfinished on the public site.
        $needsWork = Country::withCount(['hotels', 'attractions'])
            ->get()
            ->filter(fn ($c) => ! $c->image || $c->hotels_count === 0 || $c->attractions_count < 2 || ! $c->capital)
            ->values();

        return view('admin.dashboard', [
            'stats' => $stats,
            'needsWork' => $needsWork,
            'recentCountries' => Country::latest('updated_at')->take(5)->get(),
            'recentHotels' => Hotel::with('country')->latest('updated_at')->take(5)->get(),
            'newUsers' => User::where('role', 'user')->latest()->take(5)->get(),
            'ratesUpdated' => $rates->lastUpdated(),
        ]);
    }
}
