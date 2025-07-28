<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $featuredCountries = Country::take(6)->get();
            return view('home', compact('featuredCountries'));
        } catch (\Exception $e) {
            abort(500, 'An error occurred while loading the home page');
        }
    }

    public function explore()
    {
        try {
            $countries = Country::distinct()->get();
            return view('explore', compact('countries'));
        } catch (\Exception $e) {
            abort(500, 'An error occurred while loading the explore page');
        }
    }
}