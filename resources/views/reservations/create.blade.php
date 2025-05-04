@extends('layouts.app')

@section('content')
@include('partials.navbar')
<section class="bg-cream-light min-h-screen py-16 flex items-center justify-center">
    <div class="w-full max-w-2xl">
        {{-- Box elegante com informações do quarto --}}
        <div class="bg-white/95 rounded-2xl shadow-xl border border-gold/20 mb-8 flex flex-col md:flex-row overflow-hidden">
            <div class="md:w-1/3 flex-shrink-0">
                <img src="{{ $roomType->image ?? 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $roomType->name }}" class="h-40 md:h-full w-full object-cover object-center">
            </div>
            <div class="flex-1 p-6 flex flex-col gap-2 justify-center">
                <h2 class="text-2xl font-serif font-bold text-gold mb-1">{{ $roomType->name }}</h2>
                <div class="text-gray-700 text-base mb-2">{{ $roomType->description }}</div>
                <div class="flex flex-wrap gap-2 mb-2">
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
                            @php $label = $amenitiesMap[$amenity] ?? ucwords(str_replace(['_', '-'], ' ', $amenity)); @endphp
                            <span class="inline-flex items-center gap-1 bg-cream-light text-gold px-3 py-1 rounded-full text-xs font-semibold shadow">
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
                @php
                    $prices = is_array($roomType->prices_per_person) ? $roomType->prices_per_person : (is_string($roomType->prices_per_person) ? json_decode($roomType->prices_per_person, true) : []);
                    $selectedPrice = (!empty($prices) && isset($prices[$people])) ? $prices[$people] : ($roomType->price_per_night ?? 0);
                    $finalPrice = $selectedPrice + ($breakfast ? ($roomType->breakfast_extra ?? 0) : 0);
                @endphp
                <div class="text-lg font-bold text-gold mt-2">
                    Preço: R$ {{ number_format($finalPrice, 2, ',', '.') }} <span class="text-base text-gray-500 font-normal">/ noite</span>
                </div>
            </div>
        </div>
        <div class="w-full bg-white/90 rounded-2xl shadow-2xl p-8 border border-gold/20">
            <h1 class="text-3xl font-serif font-bold text-gold mb-6 text-center">Finalizar Reserva</h1>
            <form method="POST" action="{{ route('reservations.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="room_type_id" value="{{ $roomType->id }}">
                <input type="hidden" name="people" value="{{ $people }}">
                <input type="hidden" name="breakfast" value="{{ $breakfast ? 1 : 0 }}">
                <div class="mb-4">
                    <div class="text-lg font-semibold text-gray-700 mb-1">Quarto</div>
                    <div class="text-xl font-bold text-gold">{{ $roomType->name }}</div>
                    <div class="text-gray-500 text-sm">{{ $people }} pessoa{{ $people > 1 ? 's' : '' }}{{ $breakfast ? ' + Café da manhã' : '' }}</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Nome</label>
                        <input type="text" name="first_name" required class="w-full rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="Nome">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Sobrenome</label>
                        <input type="text" name="last_name" required class="w-full rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="Sobrenome">
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 md:gap-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Telefone</label>
                        <div class="flex items-center gap-2">
                            <select name="country_code" id="country_code" class="w-28 min-w-[90px] max-w-[110px] h-[48px] rounded-lg border border-gold/30 bg-cream-light px-2 py-2 focus:outline-none focus:ring-2 focus:ring-gold text-lg appearance-none">
                                <option value="+55" selected>🇧🇷 +55</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+351">🇵🇹 +351</option>
                                <option value="+44">🇬🇧 +44</option>
                                <option value="+33">🇫🇷 +33</option>
                                <option value="+49">🇩🇪 +49</option>
                                <!-- Adicione mais países se quiser -->
                            </select>
                            <input type="text" name="phone" id="phone" required class="flex-1 h-[48px] rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="(99) 99999-9999">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">E-mail</label>
                        <input type="email" name="email" required class="w-full h-[48px] rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="seu@email.com">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">País</label>
                        <select name="country" required class="w-full h-[48px] rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light appearance-none">
                            <option value="Brasil" selected>Brasil</option>
                            <option value="Estados Unidos">Estados Unidos</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Reino Unido">Reino Unido</option>
                            <option value="França">França</option>
                            <option value="Alemanha">Alemanha</option>
                            <!-- Adicione mais países se quiser -->
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Cidade</label>
                        <input type="text" name="city" required class="w-full h-[48px] rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="Cidade">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Endereço 1</label>
                        <input type="text" name="address1" required class="w-full rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="Rua, número, etc.">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Endereço 2</label>
                        <input type="text" name="address2" class="w-full rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="Complemento, apto, etc.">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">CEP / Código Postal</label>
                        <input type="text" name="zip" required class="w-full rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light" placeholder="00000-000">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Data de Check-in</label>
                        <input type="date" name="checkin" required class="w-full rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Data de Check-out</label>
                        <input type="date" name="checkout" required class="w-full rounded-lg border border-gold/30 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gold text-lg bg-cream-light">
                    </div>
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox" name="privacy_terms" id="privacy_terms" required class="form-checkbox text-gold rounded focus:ring-gold/60 focus:ring-2 mr-2">
                    <label for="privacy_terms" class="text-gray-700 text-sm">Li e aceito os <a href="#" class="text-gold underline hover:text-gold-dark">termos de privacidade</a>.</label>
                </div>
                <button type="submit" class="w-full bg-black hover:bg-gold text-white text-lg font-bold py-3 rounded-lg shadow-lg transition">Confirmar Reserva</button>
            </form>
        </div>
    </div>
</section>
@include('partials.footer')
@endsection
