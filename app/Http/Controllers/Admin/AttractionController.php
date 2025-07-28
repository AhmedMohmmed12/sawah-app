<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attractions = Attraction::with('country')->paginate(10);
        return view('admin.attractions.index', compact('attractions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.attractions.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('attractions', 'public');
        }

        Attraction::create($validated);

        return redirect()->route('admin.attractions.index')
            ->with('success', 'Attraction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attraction $attraction)
    {
        $attraction->load('country');
        return view('admin.attractions.show', compact('attraction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attraction $attraction)
    {
        $countries = Country::all();
        return view('admin.attractions.edit', compact('attraction', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attraction $attraction)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($attraction->image) {
                Storage::disk('public')->delete($attraction->image);
            }
            $validated['image'] = $request->file('image')->store('attractions', 'public');
        }

        $attraction->update($validated);

        return redirect()->route('admin.attractions.index')
            ->with('success', 'Attraction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attraction $attraction)
    {
        if ($attraction->image) {
            Storage::disk('public')->delete($attraction->image);
        }

        $attraction->delete();

        return redirect()->route('admin.attractions.index')
            ->with('success', 'Attraction deleted successfully.');
    }
} 