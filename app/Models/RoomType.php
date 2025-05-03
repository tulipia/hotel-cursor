<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'capacity',
        'bed_count',
        'bed_type',
        'amenities',
    ];

    protected $attributes = [
        'amenities' => '[]',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'amenities' => 'array',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function hasAmenity(string $amenity): bool
    {
        return in_array($amenity, $this->amenities ?? []);
    }

    public function addAmenity(string $amenity): void
    {
        $amenities = $this->amenities ?? [];
        if (!in_array($amenity, $amenities)) {
            $amenities[] = $amenity;
            $this->amenities = $amenities;
        }
    }

    public function removeAmenity(string $amenity): void
    {
        $amenities = $this->amenities ?? [];
        $this->amenities = array_values(array_diff($amenities, [$amenity]));
    }
}
