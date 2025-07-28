<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name', 'stars', 'price_per_night', 'image', 'description'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}