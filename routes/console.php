<?php

use App\Services\ExchangeRates;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('rates:update', function (ExchangeRates $rates) {
    $count = $rates->update();
    $this->info("Updated exchange rates for {$count} countries.");
})->purpose('Fetch today\'s SAR exchange rates for every country');

Schedule::command('rates:update')->daily();
