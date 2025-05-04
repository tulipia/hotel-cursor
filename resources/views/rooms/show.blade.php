@extends('layouts.app')

@section('content')
@include('partials.navbar')

{{-- HERO COM IMAGEM GRANDE E OVERLAY --}}
<section class="relative h-[420px] md:h-[520px] flex items-end">
    <img src="{{ $roomType->image ?? 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?auto=format&fit=crop&w=1170&q=80' }}" alt="{{ $roomType->name }}" class="absolute inset-0 w-full h-full object-cover object-center z-0">
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
    <div class="relative z-20 px-8 pb-12 md:pb-20 w-full">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-gold drop-shadow-lg mb-2">{{ $roomType->name }}</h1>
            <div class="text-lg md:text-2xl text-white font-light drop-shadow mb-4">{{ $roomType->description }}</div>
            <div class="flex flex-wrap gap-3 mt-4">
                @php
                    $amenitiesMap = [
                        'tv' => 'TV',
                        'ac' => 'Ar Condicionado',
                        'wifi' => 'Wi-Fi',
                        'balcony' => 'Varanda',
                        'sea_view' => 'Vista para o Mar',
                        'bathtub' => 'Banheira',
                        'minibar' => 'Frigobar',
                    ];
                @endphp
                @if(isset($roomType->amenities) && is_array($roomType->amenities))
                    @foreach($roomType->amenities as $amenity)
                        @php
                            $label = $amenitiesMap[$amenity] ?? ucwords(str_replace(['_', '-'], ' ', $amenity));
                        @endphp
                        <span class="inline-flex items-center gap-2 bg-white/80 text-gold px-4 py-1 rounded-full text-sm font-semibold shadow">
                            @switch($amenity)
                                @case('wifi')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M8.53 16.11a6 6 0 016.94 0M5.07 12.66a10 10 0 0113.86 0M1.6 9.2a14 14 0 0120.8 0"/></svg>
                                    @break
                                @case('ac')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                                    @break
                                @case('tv')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="15" rx="2"/><path d="M8 2h8"/></svg>
                                    @break
                                @case('minibar')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="6" y="3" width="12" height="18" rx="2"/><path d="M6 9h12"/></svg>
                                    @break
                                @case('sea_view')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M2 17c2 0 2-2 4-2s2 2 4 2 2-2 4-2 2 2 4 2 2-2 4-2"/></svg>
                                    @break
                                @case('bathtub')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="10" width="18" height="7" rx="3"/><path d="M7 10V7a5 5 0 0110 0v3"/></svg>
                                    @break
                                @case('balcony')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="4" y="12" width="16" height="8" rx="2"/><path d="M4 16h16"/></svg>
                                    @break
                                @default
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>
                            @endswitch
                            {{ $label }}
                        </span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

{{-- CONTEÚDO PRINCIPAL --}}
<section class="bg-cream-light py-16">
    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 px-4">
        {{-- DETALHES DO QUARTO --}}
        <div class="md:col-span-2 flex flex-col gap-6">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <div class="text-lg text-gray-700 font-medium flex items-center gap-2">
                    <span class="font-bold text-gold">Capacidade:</span> {{ $roomType->capacity }} pessoas
                </div>
                <div class="text-lg text-gray-700 font-medium flex items-center gap-2">
                    <span class="font-bold text-gold">Camas:</span> {{ $roomType->bed_count }} {{ $roomType->bed_type }}
                </div>
            </div>
            <div class="text-gray-600 text-base leading-relaxed">
                {{ $roomType->description }}
            </div>
        </div>

        {{-- BOX DE RESERVA --}}
        <div class="bg-white/90 rounded-2xl shadow-2xl p-8 flex flex-col gap-6 border border-gold/20">
            <h2 class="text-2xl font-serif font-bold text-gold mb-2">Reserve este quarto</h2>
            <form id="bookingForm" class="space-y-5">
                {{-- SELECT ESTILIZADO --}}
                <div>
                    <label for="people" class="block text-sm font-semibold text-gray-700 mb-2">Quantidade de pessoas</label>
                    <div class="relative">
                        <select id="people" name="people" class="appearance-none w-full bg-cream-light border border-gold/40 text-gray-800 py-3 px-4 pr-10 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition text-base font-medium">
                            @if(is_array($roomType->prices_per_person))
                                @foreach($roomType->prices_per_person as $qtd => $valor)
                                    <option value="{{ $qtd }}">{{ $qtd }} pessoa{{ $qtd > 1 ? 's' : '' }}</option>
                                @endforeach
                            @else
                                <option value="1">1 pessoa</option>
                            @endif
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                        </span>
                    </div>
                </div>
                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="breakfast" name="breakfast" class="form-checkbox text-gold rounded focus:ring-gold/60 focus:ring-2">
                        <span class="ml-3 text-base text-gray-700">Adicionar café da manhã <span class="text-gold font-semibold">(+R$ {{ number_format($roomType->breakfast_extra ?? 0, 2, ',', '.') }})</span></span>
                    </label>
                </div>
                @php
                    $prices = $roomType->prices_per_person ?? [];
                    $firstPrice = !empty($prices) ? min($prices) : ($roomType->price_per_night ?? 0);
                @endphp
                <div class="flex flex-col gap-1">
                    <span class="text-gray-500 text-sm">Preço total por noite</span>
                    <span class="text-3xl font-bold text-gold" id="totalPrice">R$ {{ number_format($firstPrice, 2, ',', '.') }}</span>
                </div>
                <button
                    type="button"
                    onclick="
                        const people = document.getElementById('people').value;
                        const breakfast = document.getElementById('breakfast').checked ? 1 : 0;
                        window.location.href = '{{ route('reservations.create', $roomType) }}?people=' + people + '&breakfast=' + breakfast;
                    "
                    class="w-full bg-black hover:bg-gold text-white text-lg font-bold py-3 rounded-lg shadow-lg transition mt-2"
                >
                    Reservar agora
                </button>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const prices = @json($roomType->prices_per_person ?? []);
                    const breakfastExtra = {{ $roomType->breakfast_extra ?? 0 }};
                    const peopleSelect = document.getElementById('people');
                    const breakfastCheckbox = document.getElementById('breakfast');
                    const totalPriceSpan = document.getElementById('totalPrice');
                    function updatePrice() {
                        const people = peopleSelect.value;
                        let price = prices[people] ? parseFloat(prices[people]) : 0;
                        if (breakfastCheckbox.checked) {
                            price += parseFloat(breakfastExtra);
                        }
                        totalPriceSpan.textContent = 'R$ ' + price.toLocaleString('pt-BR', {minimumFractionDigits: 2});
                    }
                    peopleSelect.addEventListener('change', updatePrice);
                    breakfastCheckbox.addEventListener('change', updatePrice);
                });
            </script>
        </div>
    </div>
</section>
@include('partials.footer')
@endsection
