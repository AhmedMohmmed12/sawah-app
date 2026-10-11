<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttractionController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $countryId = $request->integer('country') ?: null;
        $type = in_array($request->query('type'), Attraction::TYPES, true) ? $request->query('type') : null;

        $attractions = Attraction::with('country')
            ->when($search, fn ($q) => $q->where(fn ($w) => $w
                ->where('name', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")))
            ->when($countryId, fn ($q) => $q->where('country_id', $countryId))
            ->when($type, fn ($q) => $q->where('type', $type))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.attractions.index', [
            'attractions' => $attractions,
            'search' => $search,
            'countryId' => $countryId,
            'type' => $type,
            'countries' => Country::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.attractions.create', [
            'attraction' => new Attraction(['country_id' => $request->integer('country') ?: null, 'type' => 'Cultural']),
            'countries' => Country::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('attractions', 'public');
        }

        $attraction = Attraction::create($validated);

        return redirect()->route('admin.attractions.index')
            ->with('success', "{$attraction->name} has been added.");
    }

    public function show(Attraction $attraction)
    {
        return redirect()->route('admin.attractions.edit', $attraction);
    }

    public function edit(Attraction $attraction)
    {
        return view('admin.attractions.edit', [
            'attraction' => $attraction,
            'countries' => Country::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Attraction $attraction)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $this->deleteUpload($attraction->image);
            $validated['image'] = $request->file('image')->store('attractions', 'public');
        }

        $attraction->update($validated);

        return redirect()->route('admin.attractions.index')
            ->with('success', "{$attraction->name} has been updated.");
    }

    public function destroy(Attraction $attraction)
    {
        $this->deleteUpload($attraction->image);
        $attraction->delete();

        return redirect()->route('admin.attractions.index')->with('success', "{$attraction->name} has been deleted.");
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'country_id' => ['required', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'in:'.implode(',', Attraction::TYPES)],
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
