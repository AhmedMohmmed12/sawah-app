<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\TravelPreferencesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile overview.
     */
    public function overview(Request $request): View
    {
        return view('profile.overview', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'Profile updated successfully.');
    }

    /**
     * Update the user's travel preferences.
     */
    public function updateTravelPreferences(TravelPreferencesRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        $user->update([
            'preferred_climate' => $request->preferred_climate,
            'budget_range' => $request->budget_range,
            'travel_interests' => $request->interests ?? [],
        ]);

        return Redirect::route('profile.edit')->with('status', 'Travel preferences updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Increment user's search count.
     */
    public function incrementSearchCount(): void
    {
        $user = Auth::user();
        if ($user) {
            $user->increment('search_count');
        }
    }

    /**
     * Get user's travel statistics.
     */
    public function getTravelStats(): array
    {
        $user = Auth::user();
        
        return [
            'search_count' => $user ? $user->search_count : 0,
            'favorites_count' => $user ? $user->favorites_count : 0,
            'preferred_climate' => $user ? $user->preferred_climate : null,
            'budget_range' => $user ? $user->budget_range : null,
            'travel_interests' => $user ? $user->travel_interests : [],
        ];
    }
}
