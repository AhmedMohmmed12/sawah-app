<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'code', 'capital', 'region', 'currency', 'exchange_rate_to_sar',
        'climate', 'best_months', 'daily_budget_min', 'daily_budget_max',
        'image', 'image_caption', 'image_credit', 'description',
    ];

    protected $casts = [
        'exchange_rate_to_sar' => 'float',
        'daily_budget_min' => 'float',
        'daily_budget_max' => 'float',
    ];

    protected $appends = ['image_url'];

    protected static function booted(): void
    {
        static::saving(function (Country $country) {
            if (blank($country->slug)) {
                $country->slug = Str::slug($country->name);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        return ImageHelper::getImageUrl($this->image) ?? ImageHelper::getPlaceholderUrl('country');
    }

    /** How many units of the local currency one riyal buys, e.g. "1 SAR = 0.23 EUR". */
    public function getRateFromSarAttribute(): ?float
    {
        return $this->exchange_rate_to_sar > 0 ? 1 / $this->exchange_rate_to_sar : null;
    }

    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
}
