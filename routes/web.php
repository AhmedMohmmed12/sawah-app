<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ProfileController;

// Main application routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/explore', [HomeController::class, 'explore'])->name('explore');
Route::get('/country/{id}', [CountryController::class, 'show'])->name('country.show');
Route::get('/suggest-destination', [DestinationController::class, 'suggest'])->name('destination.suggest');
Route::post('/find-destination', [DestinationController::class, 'findDestination'])->name('destination.find');

// Dashboard route (requires authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (requires authentication)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/overview', [ProfileController::class, 'overview'])->name('profile.overview');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/travel-preferences', [ProfileController::class, 'updateTravelPreferences'])->name('profile.travel-preferences');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
