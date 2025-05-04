<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Request $request, RoomType $roomType)
    {
        // Recebe parâmetros opcionais da query (pessoas, café da manhã)
        $people = $request->input('people', 1);
        $breakfast = $request->boolean('breakfast', false);
        return view('reservations.create', compact('roomType', 'people', 'breakfast'));
    }

    public function store(Request $request)
    {
        // Aqui você pode validar e salvar a reserva
        // Exemplo de validação:
        $data = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:30',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'people' => 'required|integer|min:1',
            'breakfast' => 'boolean',
        ]);
        // Salvar reserva (exemplo: Reservation::create($data))
        // Redirecionar com mensagem de sucesso
        return redirect()->route('rooms.index')->with('success', 'Reserva realizada com sucesso!');
    }
}
