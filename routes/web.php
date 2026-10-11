<?php

use App\Http\Controllers\Admin\AttractionController as AdminAttractionController;
use App\Http\Controllers\Admin\CountryController as AdminCountryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Managers work in the admin panel
    if (Auth::check() && Auth::user()->hasRole('manager')) {
        return redirect()->route('admin.dashboard');
    }

    return app(HomeController::class)->index();
})->name('home');

// Browsing is open to everyone
Route::get('/destinations', [HomeController::class, 'explore'])->name('explore');
Route::get('/destinations/{slug}', [CountryController::class, 'show'])->name('country.show');
Route::get('/hotels', [BrowseController::class, 'hotels'])->name('hotels.index');
Route::get('/things-to-do', [BrowseController::class, 'attractions'])->name('attractions.index');
Route::get('/photo-credits', [BrowseController::class, 'credits'])->name('credits');

// Old URLs
Route::redirect('/explore', '/destinations', 301);
Route::get('/country/{id}', fn (int $id) => redirect()->route('country.show', Country::findOrFail($id)->slug, 301))->whereNumber('id');

Route::middleware(['auth'])->group(function () {
    Route::get('/suggest-destination', [DestinationController::class, 'suggest'])->name('destination.suggest')->middleware('role:user');
    Route::match(['get', 'post'], '/find-destination', [DestinationController::class, 'findDestination'])->name('destination.find')->middleware('role:user');

    Route::get('/dashboard', function () {
        if (Auth::user()->hasRole('manager')) {
            return redirect()->route('admin.dashboard');
        }

        return app(HomeController::class)->dashboard();
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('role:user');
    Route::get('/profile/overview', [ProfileController::class, 'overview'])->name('profile.overview');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/travel-preferences', [ProfileController::class, 'updateTravelPreferences'])->name('profile.travel-preferences')->middleware('role:user');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'adminEdit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('countries', AdminCountryController::class);
    Route::resource('attractions', AdminAttractionController::class);
    Route::resource('hotels', AdminHotelController::class);
});

require __DIR__.'/auth.php';
