<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));

        $countries = Country::withCount(['attractions', 'hotels'])
            ->when($search, fn ($q) => $q->where(fn ($w) => $w
                ->where('name', 'like', "%{$search}%")
                ->orWhere('capital', 'like', "%{$search}%")
                ->orWhere('currency', 'like', "%{$search}%")))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.countries.index', compact('countries', 'search'));
    }

    public function create()
    {
        return view('admin.countries.create', ['country' => new Country(['climate' => 'Mild'])]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('countries', 'public');
        }

        $country = Country::create($validated);

        return redirect()->route('admin.countries.show', $country)
            ->with('success', "{$country->name} has been added.");
    }

    public function show(Country $country)
    {
        $country->load(['attractions', 'hotels' => fn ($q) => $q->orderBy('price_per_night')]);

        return view('admin.countries.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $validated = $this->validated($request, $country);

        if ($request->hasFile('image')) {
            $this->deleteUpload($country->image);
            $validated['image'] = $request->file('image')->store('countries', 'public');
        }

        $country->update($validated);

        return redirect()->route('admin.countries.show', $country)
            ->with('success', "{$country->name} has been updated.");
    }

    public function destroy(Country $country)
    {
        $this->deleteUpload($country->image);
        $country->delete();

        return redirect()->route('admin.countries.index')
            ->with('success', "{$country->name} and its hotels and attractions have been deleted.");
    }

    private function validated(Request $request, ?Country $country = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'size:2', Rule::unique('countries', 'code')->ignore($country)],
            'capital' => ['nullable', 'string', 'max:255'],
            'region' => ['nullable', 'string', 'max:50'],
            'currency' => ['required', 'string', 'size:3'],
            'exchange_rate_to_sar' => ['required', 'numeric', 'gt:0'],
            'climate' => ['required', 'in:Warm,Mild,Cold'],
            'best_months' => ['nullable', 'string', 'max:255'],
            'daily_budget_min' => ['required', 'numeric', 'min:0'],
            'daily_budget_max' => ['required', 'numeric', 'min:0', 'gte:daily_budget_min'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'image_caption' => ['nullable', 'string', 'max:255'],
            'image_credit' => ['nullable', 'string', 'max:255'],
        ]);
    }

    /** Remove an uploaded file; photos shipped in public/images are left alone. */
    private function deleteUpload(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'images/') && ! filter_var($path, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($path);
        }
    }
}
