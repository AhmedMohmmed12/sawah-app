<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    public const TYPES = ['Cultural', 'Nature', 'Adventure', 'Beach', 'Family', 'Shopping'];

    protected $fillable = ['country_id', 'name', 'city', 'description', 'image', 'image_credit', 'type'];

    public function getImageUrlAttribute()
    {
        return ImageHelper::getImageUrl($this->image) ?? ImageHelper::getPlaceholderUrl('attraction');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
