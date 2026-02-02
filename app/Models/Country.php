<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'currency', 'exchange_rate_to_sar', 
        'climate', 'daily_budget_min', 'daily_budget_max', 
        'image', 'description'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return \App\Helpers\ImageHelper::getImageUrl($this->image);
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