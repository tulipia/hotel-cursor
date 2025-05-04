<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::with('rooms')->paginate(12);
        return view('rooms.index', compact('roomTypes'));
    }

    public function show($id)
    {
        $roomType = RoomType::with('rooms')->findOrFail($id);
        return view('rooms.show', compact('roomType'));
    }
}
