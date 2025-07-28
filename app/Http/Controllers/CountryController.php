<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryController extends Controller
{
    public function show($id)
    {
        try {
            $country = Country::with(['attractions', 'hotels'])->findOrFail($id);
            return view('country.show', compact('country'));
        } catch (ModelNotFoundException $e) {
            abort(404, 'Country not found');
        } catch (\Exception $e) {
            abort(500, 'An error occurred while loading the country');
        }
    }
}