<section id="contact" class="py-20 bg-cream-light">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Entre em <span class="text-gold">Contato</span></h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Tem dúvidas, sugestões ou deseja fazer uma reserva especial? Fale conosco!
            </p>
        </div>
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <form method="POST" action="#">
                @csrf
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Nome</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-gold" required>
                </div>
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">E-mail</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-gold" required>
                </div>
                <div class="mb-6">
                    <label for="message" class="block text-gray-700 font-semibold mb-2">Mensagem</label>
                    <textarea id="message" name="message" rows="5" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-gold" required></textarea>
                </div>
                <button type="submit" class="bg-gold hover:bg-gold-dark text-white px-8 py-3 rounded font-semibold transition">Enviar</button>
            </form>
        </div>
    </div>
</section>
