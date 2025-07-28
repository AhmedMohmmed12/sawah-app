<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'preferred_climate',
        'budget_range',
        'travel_interests',
        'search_count',
        'favorites_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'travel_interests' => 'array',
        ];
    }

    /**
     * Get the user's travel interests as an array
     */
    public function getTravelInterestsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Set the user's travel interests
     */
    public function setTravelInterestsAttribute($value)
    {
        $this->attributes['travel_interests'] = is_array($value) ? json_encode($value) : $value;
    }
}
