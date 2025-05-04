<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'room_number',
        'slug',
        'floor',
        'status',
        'notes',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($room) {
            if (empty($room->slug) && !empty($room->room_number)) {
                $room->slug = str_slug($room->room_number . '-' . uniqid());
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
