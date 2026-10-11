<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    /** Which attraction types make a country good for each kind of trip. */
    public const TRIP_TYPES = [
        'Cultural' => ['Cultural'],
        'Adventure' => ['Adventure', 'Nature'],
        'Relaxation' => ['Beach', 'Nature'],
        'Family' => ['Family', 'Beach'],
        'Business' => ['Cultural', 'Shopping'],
    ];

    public function suggest()
    {
        return view('destination.suggest', [
            'search' => Auth::user()->searchDefaults(),
        ]);
    }

    public function findDestination(Request $request)
    {
        $validated = $request->validate([
            'budget_min' => 'nullable|integer|min:0|max:100000',
            'budget_max' => 'nullable|integer|min:0|max:100000',
            'budget' => 'nullable|string|max:30',
            'weather' => 'nullable|in:Warm,Mild,Cold,No preference',
            'trip_type' => 'nullable|in:'.implode(',', array_keys(self::TRIP_TYPES)),
        ]);

        [$min, $max] = $this->budgetRange($validated);
        $weather = ($validated['weather'] ?? null) === 'No preference' ? null : ($validated['weather'] ?? null);
        $tripType = $validated['trip_type'] ?? null;
        $wanted = self::TRIP_TYPES[$tripType] ?? [];

        $countries = Country::with('attractions')->withCount('hotels')->get();

        $scored = $countries->map(function (Country $country) use ($min, $max, $weather, $wanted) {
            $budgetFits = $max === null
                || ($country->daily_budget_min <= $max && $country->daily_budget_max >= ($min ?? 0));
            $weatherFits = ! $weather || $country->climate === $weather;
            $matching = $country->attractions->whereIn('type', $wanted);

            return (object) [
                'country' => $country,
                'budgetFits' => $budgetFits,
                'weatherFits' => $weatherFits,
                'matching' => $matching,
                // Closer to the middle of the user's range ranks higher.
                'distance' => $max === null ? 0 : abs($country->daily_budget_min - (($min ?? 0) + $max) / 2),
            ];
        });

        $results = $scored
            ->filter(fn ($r) => $r->budgetFits && $r->weatherFits)
            ->sortBy([fn ($a, $b) => $b->matching->count() <=> $a->matching->count(), fn ($a, $b) => $a->distance <=> $b->distance])
            ->values();

        // Nothing fits exactly: show the nearest options and say so.
        $relaxed = false;
        if ($results->isEmpty()) {
            $relaxed = true;
            $results = $scored
                ->sortBy([fn ($a, $b) => ($b->budgetFits + $b->weatherFits) <=> ($a->budgetFits + $a->weatherFits), fn ($a, $b) => $a->distance <=> $b->distance])
                ->take(4)
                ->values();
        }

        Auth::user()?->increment('search_count');

        return view('destination.results', [
            'results' => $results->take(12),
            'relaxed' => $relaxed,
            'criteria' => [
                'budget_min' => $min,
                'budget_max' => $max,
                'weather' => $validated['weather'] ?? 'No preference',
                'trip_type' => $tripType,
            ],
            'wantedTypes' => $wanted,
        ]);
    }

    /** Accepts budget_min/budget_max, or the older "100-300" text field. */
    private function budgetRange(array $input): array
    {
        $min = $input['budget_min'] ?? null;
        $max = $input['budget_max'] ?? null;

        if ($min === null && $max === null && ! empty($input['budget'])) {
            $parts = array_map('trim', explode('-', str_replace([',', '$', 'SAR'], '', $input['budget'])));
            $min = is_numeric($parts[0] ?? null) ? (int) $parts[0] : null;
            $max = is_numeric($parts[1] ?? null) ? (int) $parts[1] : null;
        }

        if ($min !== null && $max !== null && $min > $max) {
            [$min, $max] = [$max, $min];
        }

        return [$min, $max];
    }
}
