<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ReservationController;

Route::get('/', LandingController::class);

Route::resource('rooms', RoomController::class)->parameters([
    'rooms' => 'room:slug',
]);

Route::get('reservar/{roomType}', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('reservar', [ReservationController::class, 'store'])->name('reservations.store');
