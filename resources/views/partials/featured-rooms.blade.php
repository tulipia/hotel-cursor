<section class="py-20 bg-cream-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Tipos de <span class="text-gold">Quartos & Suítes</span></h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Descubra nossas categorias de acomodações, pensadas para seu conforto e relaxamento.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($roomTypes as $type)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                    <img src="{{ $type->image ?? 'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?auto=format&fit=crop&w=1170&q=80' }}" alt="{{ $type->name }}" class="h-48 w-full object-cover">
                    <div class="p-6 flex-1 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">{{ $type->name }}</h3>
                        <p class="text-gray-600 mb-4 flex-1">{{ $type->description }}</p>
                        <div class="mb-2 text-sm text-gray-500">Capacidade: {{ $type->capacity ?? '-' }} | Camas: {{ $type->bed_count ?? '-' }} {{ $type->bed_type ?? '' }}</div>
                        <div class="mb-2 text-sm text-gray-500">Amenidades: {{ isset($type->amenities) ? implode(', ', is_array($type->amenities) ? $type->amenities : json_decode($type->amenities, true)) : '-' }}</div>
                        @php
                            $prices = is_array($type->prices_per_person) ? $type->prices_per_person : (is_string($type->prices_per_person) ? json_decode($type->prices_per_person, true) : []);
                            $minPrice = (!empty($prices) && is_array($prices)) ? min($prices) : ($type->price_per_night ?? 0);
                        @endphp
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-gold font-bold text-lg">A partir de R$ {{ number_format($minPrice, 2, ',', '.') }}</span>
                            <a href="#" class="bg-gold hover:bg-gold-dark text-white px-4 py-2 rounded transition opacity-50 cursor-not-allowed">Ver detalhes</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
