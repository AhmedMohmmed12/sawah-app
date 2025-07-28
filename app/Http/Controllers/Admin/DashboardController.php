<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Attraction;
use App\Models\Hotel;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_countries' => Country::count(),
            'total_attractions' => Attraction::count(),
            'total_hotels' => Hotel::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_managers' => User::where('role', 'manager')->count(),
        ];

        $recentCountries = Country::latest()->take(5)->get();
        $recentAttractions = Attraction::with('country')->latest()->take(5)->get();
        $recentHotels = Hotel::with('country')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentCountries', 'recentAttractions', 'recentHotels'));
    }
} 