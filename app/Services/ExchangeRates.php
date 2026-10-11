<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Keeps countries.exchange_rate_to_sar (riyals per one unit of the local
 * currency) in line with the free open.er-api.com feed.
 */
class ExchangeRates
{
    private const URL = 'https://open.er-api.com/v6/latest/SAR';

    private const UPDATED_KEY = 'exchange_rates.updated_at';

    /**
     * Fetch today's rates and update every country. Returns the number of
     * countries updated.
     */
    public function update(): int
    {
        $response = Http::timeout(10)->retry(2, 500)->get(self::URL)->throw();
        $rates = $response->json('rates') ?? [];

        if (($response->json('result') ?? null) !== 'success' || empty($rates)) {
            throw new \RuntimeException('Exchange rate feed returned no rates.');
        }

        $updated = 0;
        foreach (Country::all() as $country) {
            $perSar = $rates[strtoupper($country->currency)] ?? null;
            if ($perSar > 0) {
                $country->update(['exchange_rate_to_sar' => round(1 / $perSar, 8)]);
                $updated++;
            }
        }

        Cache::forever(self::UPDATED_KEY, now()->toIso8601String());

        return $updated;
    }

    /**
     * Update at most once a day, without a cron job. Failures are logged and
     * the stored rates are kept.
     */
    public function refreshIfStale(): void
    {
        if (! $this->isStale()) {
            return;
        }

        Cache::lock('exchange_rates.refresh', 30)->get(function () {
            if (! $this->isStale()) {
                return;
            }

            try {
                $this->update();
            } catch (Throwable $e) {
                // Try again in an hour rather than on every request.
                Cache::forever(self::UPDATED_KEY, now()->subDay()->addHour()->toIso8601String());
                Log::warning('Exchange rate refresh failed: '.$e->getMessage());
            }
        });
    }

    public function lastUpdated(): ?\Illuminate\Support\Carbon
    {
        $value = Cache::get(self::UPDATED_KEY);

        return $value ? \Illuminate\Support\Carbon::parse($value) : null;
    }

    private function isStale(): bool
    {
        $last = $this->lastUpdated();

        return ! $last || $last->lt(now()->subDay());
    }
}
