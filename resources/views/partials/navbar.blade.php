<nav class="bg-white/90 backdrop-blur-sm sticky top-0 z-50 shadow-sm" x-data="{ isOpen: false }">
    <div class="container-custom py-4">
        <div class="flex justify-between items-center">
            <div>
                <a href="/" class="font-serif text-2xl font-bold text-navy">
                    LuxStay
                </a>
            </div>

            <!-- Navegação Desktop -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="/" class="text-charcoal hover:text-gold transition-colors">Início</a>
                <a href="/rooms" class="text-charcoal hover:text-gold transition-colors">Quartos & Suítes</a>
                <a href="/#amenities" class="text-charcoal hover:text-gold transition-colors">Amenidades</a>
                <a href="/#about" class="text-charcoal hover:text-gold transition-colors">Sobre</a>
                <a href="/#contact" class="text-charcoal hover:text-gold transition-colors">Contato</a>
                <a href="#" class="bg-gold hover:bg-gold-dark text-white px-5 py-2 rounded font-semibold transition">Reservar Agora</a>
            </div>

            <!-- Botão menu mobile -->
            <div class="md:hidden">
                <button @click="isOpen = !isOpen" class="text-navy focus:outline-none">
                    <template x-if="!isOpen">
                        <i class="fa-solid fa-bars fa-lg"></i>
                    </template>
                    <template x-if="isOpen">
                        <i class="fa-solid fa-xmark fa-lg"></i>
                    </template>
                </button>
            </div>
        </div>

        <!-- Navegação Mobile -->
        <div x-show="isOpen" x-transition class="md:hidden pt-4 pb-6 space-y-4">
            <a href="/" class="block text-charcoal hover:text-gold transition-colors py-2" @click="isOpen = false">Início</a>
            <a href="/rooms" class="block text-charcoal hover:text-gold transition-colors py-2" @click="isOpen = false">Quartos & Suítes</a>
            <a href="/#amenities" class="block text-charcoal hover:text-gold transition-colors py-2" @click="isOpen = false">Amenidades</a>
            <a href="/#about" class="block text-charcoal hover:text-gold transition-colors py-2" @click="isOpen = false">Sobre</a>
            <a href="/#contact" class="block text-charcoal hover:text-gold transition-colors py-2" @click="isOpen = false">Contato</a>
            <a href="#" class="w-full block text-center bg-gold hover:bg-gold-dark text-white px-5 py-2 rounded font-semibold transition">Reservar Agora</a>
        </div>
    </div>
</nav>
