<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name', 'city', 'stars', 'price_per_night', 'image', 'image_credit', 'description'];

    protected $casts = [
        'price_per_night' => 'float',
    ];

    public function getImageUrlAttribute()
    {
        return ImageHelper::getImageUrl($this->image) ?? ImageHelper::getPlaceholderUrl('hotel');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
