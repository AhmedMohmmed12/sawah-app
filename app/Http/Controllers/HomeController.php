<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Country;
use App\Models\Hotel;
use App\Services\ExchangeRates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /** Countries shown first on the home page, roughly by how often Saudi travellers pick them. */
    private const FEATURED = ['turkey', 'united-arab-emirates', 'egypt', 'georgia', 'malaysia', 'italy', 'japan', 'bosnia-and-herzegovina'];

    public function __construct(private ExchangeRates $rates)
    {
    }

    public function index()
    {
        $this->rates->refreshIfStale();

        // Same picks all day, different ones tomorrow.
        $seed = (int) now()->format('Ymd');

        $featured = Country::whereIn('slug', self::FEATURED)->get()
            ->sortBy(fn ($c) => array_search($c->slug, self::FEATURED))->values();

        return view('home', [
            'featured' => $featured,
            'cheapest' => Country::orderBy('daily_budget_min')->take(5)->get(),
            'hotels' => Hotel::with('country')->where('stars', 5)->inRandomOrder($seed)->take(8)->get(),
            'attractions' => Attraction::with('country')->inRandomOrder($seed)->take(8)->get(),
            'counts' => [
                'countries' => Country::count(),
                'hotels' => Hotel::count(),
                'attractions' => Attraction::count(),
                'hotel_from' => Hotel::min('price_per_night'),
            ],
            'ratesUpdated' => $this->rates->lastUpdated(),
            'search' => Auth::user()?->searchDefaults() ?? [],
        ]);
    }

    public function explore(Request $request)
    {
        $this->rates->refreshIfStale();

        $filters = $request->validate([
            'region' => 'nullable|string|max:50',
            'climate' => 'nullable|in:Warm,Mild,Cold',
            'max_budget' => 'nullable|integer|min:0',
            'sort' => 'nullable|in:budget,name,budget_desc',
        ]);

        $countries = Country::withCount(['hotels', 'attractions'])
            ->when($filters['region'] ?? null, fn ($q, $v) => $q->where('region', $v))
            ->when($filters['climate'] ?? null, fn ($q, $v) => $q->where('climate', $v))
            ->when($filters['max_budget'] ?? null, fn ($q, $v) => $q->where('daily_budget_min', '<=', $v))
            ->when(($filters['sort'] ?? 'budget') === 'name', fn ($q) => $q->orderBy('name'))
            ->when(($filters['sort'] ?? 'budget') === 'budget_desc', fn ($q) => $q->orderByDesc('daily_budget_min'))
            ->orderBy('daily_budget_min')
            ->get();

        return view('explore', [
            'countries' => $countries,
            'filters' => $filters,
            'regions' => Country::whereNotNull('region')->distinct()->orderBy('region')->pluck('region'),
            'total' => Country::count(),
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();
        $defaults = $user->searchDefaults();

        $picks = Country::query()
            ->when($user->preferred_climate && $user->preferred_climate !== 'no_preference',
                fn ($q) => $q->where('climate', ucfirst($user->preferred_climate)))
            ->when($user->budget_range, fn ($q) => $q
                ->where('daily_budget_min', '<=', $defaults['budget_max'])
                ->where('daily_budget_max', '>=', $defaults['budget_min']))
            ->orderBy('daily_budget_min')
            ->take(4)
            ->get();

        return view('dashboard', [
            'user' => $user,
            'picks' => $picks,
            'hasPreferences' => $user->preferred_climate || $user->budget_range || ! empty($user->travel_interests),
            'search' => $defaults,
        ]);
    }
}
