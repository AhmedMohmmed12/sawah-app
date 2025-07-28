<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    public function suggest()
    {
        return view('destination.suggest');
    }

    public function findDestination(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'budget' => 'nullable|string',
            'weather' => 'nullable|string',
            'trip_type' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $budget = $request->budget;
            $weather = $request->weather;
            $tripType = $request->trip_type;

            $query = Country::query();

            // Filter by budget
            if ($budget && str_contains($budget, '-')) {
                $budgetRange = explode('-', str_replace(['$', ','], '', $budget));
                if (count($budgetRange) === 2) {
                    [$min, $max] = $budgetRange;
                    $query->where('daily_budget_min', '>=', (float)$min)
                        ->where('daily_budget_max', '<=', (float)$max);
                }
            }

            // Filter by weather
            if ($weather && $weather !== 'No preference') {
                $query->where('climate', 'like', '%' . $weather . '%');
            }

            $recommendations = $query->take(6)->get();

            // Track search for authenticated users
            if (Auth::check()) {
                Auth::user()->increment('search_count');
            }

            return view('destination.results', compact('recommendations', 'request'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while finding destinations. Please try again.')
                ->withInput();
        }
    }
}