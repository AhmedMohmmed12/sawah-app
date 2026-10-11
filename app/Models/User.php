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
        'role',
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

    /**
     * Check if user is a manager
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Check if user is a regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Check if user has manager role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /** Daily budget options in SAR (key => [min, max]). Older USD-era keys are still accepted. */
    public const BUDGET_RANGES = [
        'under-300' => [0, 300, 'Under SAR 300 a day'],
        '300-600' => [300, 600, 'SAR 300–600 a day'],
        '600-1000' => [600, 1000, 'SAR 600–1,000 a day'],
        '1000-1500' => [1000, 1500, 'SAR 1,000–1,500 a day'],
        '1500-plus' => [1500, 3000, 'More than SAR 1,500 a day'],
    ];

    public const INTERESTS = [
        'culture' => 'History and culture',
        'nature' => 'Nature and mountains',
        'adventure' => 'Adventure',
        'relaxation' => 'Beaches and rest',
        'food' => 'Food',
        'shopping' => 'Shopping',
    ];

    /** Values to pre-fill the search form with, based on saved preferences. */
    public function searchDefaults(): array
    {
        [$min, $max] = self::BUDGET_RANGES[$this->budget_range] ?? [300, 800];

        $tripType = match (true) {
            in_array('adventure', $this->travel_interests ?? []) => 'Adventure',
            in_array('relaxation', $this->travel_interests ?? []) => 'Relaxation',
            default => 'Cultural',
        };

        return [
            'budget_min' => $min,
            'budget_max' => $max,
            'weather' => $this->preferred_climate && $this->preferred_climate !== 'no_preference'
                ? ucfirst($this->preferred_climate)
                : 'No preference',
            'trip_type' => $tripType,
        ];
    }
}
