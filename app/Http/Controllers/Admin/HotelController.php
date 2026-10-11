<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $countryId = $request->integer('country') ?: null;

        $hotels = Hotel::with('country')
            ->when($search, fn ($q) => $q->where(fn ($w) => $w
                ->where('name', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")))
            ->when($countryId, fn ($q) => $q->where('country_id', $countryId))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.hotels.index', [
            'hotels' => $hotels,
            'search' => $search,
            'countryId' => $countryId,
            'countries' => Country::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.hotels.create', [
            'hotel' => new Hotel(['country_id' => $request->integer('country') ?: null, 'stars' => 4]),
            'countries' => Country::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel = Hotel::create($validated);

        return redirect()->route('admin.hotels.index')
            ->with('success', "{$hotel->name} has been added.");
    }

    public function show(Hotel $hotel)
    {
        return redirect()->route('admin.hotels.edit', $hotel);
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', [
            'hotel' => $hotel,
            'countries' => Country::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $this->deleteUpload($hotel->image);
            $validated['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update($validated);

        return redirect()->route('admin.hotels.index')
            ->with('success', "{$hotel->name} has been updated.");
    }

    public function destroy(Hotel $hotel)
    {
        $this->deleteUpload($hotel->image);
        $hotel->delete();

        return redirect()->route('admin.hotels.index')->with('success', "{$hotel->name} has been deleted.");
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'country_id' => ['required', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'stars' => ['required', 'integer', 'between:1,5'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'image_credit' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function deleteUpload(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'images/') && ! filter_var($path, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($path);
        }
    }
}
