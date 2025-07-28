<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CountryController as AdminCountryController;
use App\Http\Controllers\Admin\AttractionController as AdminAttractionController;
use App\Http\Controllers\Admin\HotelController as AdminHotelController;

// Public routes (accessible to everyone)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes for authenticated users only (excluding admin users)
Route::middleware(['auth'])->group(function () {
    Route::get('/explore', [HomeController::class, 'explore'])->name('explore')->middleware('role:user');
    Route::get('/country/{id}', [CountryController::class, 'show'])->name('country.show')->middleware('role:user');
    Route::get('/suggest-destination', [DestinationController::class, 'suggest'])->name('destination.suggest')->middleware('role:user');
    Route::post('/find-destination', [DestinationController::class, 'findDestination'])->name('destination.find')->middleware('role:user');
    
    // Dashboard route (requires authentication)
    Route::get('/dashboard', function () {
        // Redirect admin users to admin dashboard
        if (Auth::user()->hasRole('manager')) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // Profile routes (requires authentication)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('role:user');
    Route::get('/profile/overview', [ProfileController::class, 'overview'])->name('profile.overview');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/travel-preferences', [ProfileController::class, 'updateTravelPreferences'])->name('profile.travel-preferences')->middleware('role:user');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes (requires manager role)
Route::middleware(['auth', 'role:manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Admin profile routes
    Route::get('/profile', [ProfileController::class, 'adminEdit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Country management
    Route::resource('countries', AdminCountryController::class);
    
    // Attraction management
    Route::resource('attractions', AdminAttractionController::class);
    
    // Hotel management
    Route::resource('hotels', AdminHotelController::class);
});

// Include authentication routes
require __DIR__.'/auth.php';
