@extends('layouts.app')

@section('content')
@include('partials.navbar')
<section class="py-20 bg-cream-light min-h-screen">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Escolha seu <span class="text-gold">Tipo de Quarto</span></h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Selecione a quantidade desejada de cada tipo de quarto e faça sua reserva como no Booking.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($roomTypes as $type)
                @php
                    $availableRooms = $type->rooms->where('status', 'available');
                    $maxQty = $availableRooms->count();
                @endphp
                <a href="{{ route('rooms.show', $type->id) }}" class="block bg-white rounded-lg shadow-lg overflow-hidden flex flex-col hover:scale-105 transition-transform duration-200">
                    <img src="{{ $type->image ?? 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?auto=format&fit=crop&w=1170&q=80' }}" alt="{{ $type->name }}" class="h-48 w-full object-cover">
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">{{ $type->name }}</h3>
                        <p class="text-gray-600 mb-4 flex-1">{{ $type->description }}</p>
                        <div class="mb-2 text-sm text-gray-500">Capacidade: {{ $type->capacity ?? '-' }} | Camas: {{ $type->bed_count ?? '-' }} {{ $type->bed_type ?? '' }}</div>
                        <div class="mb-2 text-sm text-gray-500">Amenidades: {{ isset($type->amenities) ? implode(', ', is_array($type->amenities) ? $type->amenities : json_decode($type->amenities, true)) : '-' }}</div>
                        <div class="mb-2 text-sm text-gold font-semibold">{{ $maxQty }} disponível(is)</div>
                        @php
                            $prices = is_array($type->prices_per_person) ? $type->prices_per_person : (is_string($type->prices_per_person) ? json_decode($type->prices_per_person, true) : []);
                            $minPrice = (!empty($prices) && is_array($prices)) ? min($prices) : ($type->price_per_night ?? 0);
                        @endphp
                        <div class="mt-auto flex items-center justify-between">
                            <span class="text-gold font-bold text-lg">A partir de R$ {{ number_format($minPrice, 2, ',', '.') }} <span class="text-base text-gray-500 font-normal">/ noite</span></span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@include('partials.footer')
@endsection
