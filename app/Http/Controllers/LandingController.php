<?php

namespace App\Http\Controllers;

use App\Models\RoomType;

class LandingController extends Controller
{
    public function __invoke()
    {
        $roomTypes = RoomType::all();

        // Coletar todas as amenidades distintas dos tipos de quarto
        $amenities = $roomTypes
            ->pluck('amenities')
            ->filter()
            ->flatMap(function ($item) {
                if (is_array($item)) return $item;
                $decoded = json_decode($item, true);
                return is_array($decoded) ? $decoded : [];
            })
            ->unique()
            ->values()
            ->all();

        return view('welcome', compact('roomTypes', 'amenities'));
    }
}
