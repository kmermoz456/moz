<x-app-layout
    title="Rejoindre la communauté WhatsApp — ITF"
    description="Rejoignez le groupe WhatsApp officiel d'ITF : informations sur les cours, conseils d'orientation, aide académique et annonces importantes.">
    {{-- Bannière --}}
    <section class="relative bg-itf-dark text-itf-white">
        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1600&q=60"
             alt="Étudiants échangeant en groupe" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative max-w-6xl mx-auto px-4 py-20 text-center">
            <span class="inline-block bg-green-500 text-itf-white text-xs font-bold uppercase tracking-wide px-3 py-1 rounded-full mb-4">
                Communauté ITF
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight">
                Rejoignez notre groupe WhatsApp
            </h1>
            <p class="mt-4 text-lg text-itf-cream max-w-2xl mx-auto">
                Restez connecté à la communauté ITF : cours, conseils, aide académique et annonces importantes,
                directement sur votre téléphone.
            </p>
            <a href="{{ $lienWhatsapp }}" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 mt-8 bg-green-500 text-itf-white font-bold px-8 py-4 rounded-lg text-lg hover:opacity-90 transition">
                💬 Rejoindre le groupe WhatsApp maintenant
            </a>
        </div>
    </section>

    {{-- Avantages --}}
    <section class="max-w-6xl mx-auto px-4 py-16">
        <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Pourquoi rejoindre le groupe ?</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($avantages as $avantage)
                <div class="border border-gray-200 rounded-xl p-6 text-center hover:shadow-lg transition">
                    <span class="text-4xl">{{ $avantage['icone'] }}</span>
                    <h3 class="font-bold text-itf-dark mt-3 mb-2">{{ $avantage['titre'] }}</h3>
                    <p class="text-sm text-gray-600">{{ $avantage['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA final --}}
    <section class="bg-itf-cream py-16">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <p class="text-itf-blue font-semibold uppercase tracking-wide text-sm mb-2">Inscriptions ouvertes</p>
            <h2 class="text-2xl sm:text-3xl font-bold text-itf-dark mb-4">
                Ne restez pas seul face à vos cours
            </h2>
            <p class="text-gray-700 mb-8">
                Des centaines d'étudiants échangent déjà sur le groupe. Rejoignez-les et bénéficiez d'un
                accompagnement continu tout au long de l'année universitaire.
            </p>
            <a href="{{ $lienWhatsapp }}" target="_blank" rel="noopener"
               class="inline-block bg-green-500 text-itf-white font-bold px-8 py-4 rounded-lg hover:opacity-90 transition">
                Rejoindre le groupe WhatsApp
            </a>
        </div>
    </section>
</x-app-layout>
