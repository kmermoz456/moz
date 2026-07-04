<x-app-layout>
    {{-- Bannière --}}
    <section class="relative bg-itf-dark text-itf-white">
        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1600&q=60"
             alt="Campus universitaire" class="absolute inset-0 w-full h-full object-cover opacity-40">
        <div class="relative max-w-6xl mx-auto px-4 py-20 text-center">
            <h1 class="text-3xl sm:text-5xl font-extrabold">À propos d'ITF</h1>
            <p class="mt-4 text-lg text-itf-cream max-w-2xl mx-auto">
                Intellect Tronc SN Formation, la référence du renforcement académique en Sciences de la Nature à
                l'Université Nangui Abrogoua.
            </p>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-10">
        <div class="bg-itf-cream rounded-2xl p-8">
            <h2 class="text-xl font-bold text-itf-dark mb-3">Notre mission</h2>
            <p class="text-gray-700 leading-relaxed">
                Accompagner les nouveaux bacheliers et les étudiants de Licence 1 et Licence 2 en Sciences de la
                Nature dans leur réussite universitaire, grâce à un renforcement académique de qualité, accessible
                et personnalisé.
            </p>
        </div>
        <div class="bg-itf-cream rounded-2xl p-8">
            <h2 class="text-xl font-bold text-itf-dark mb-3">Notre vision</h2>
            <p class="text-gray-700 leading-relaxed">
                Devenir la structure de référence du renforcement universitaire en Sciences de la Nature en Côte
                d'Ivoire, en formant chaque année davantage d'étudiants confiants et prêts à réussir.
            </p>
        </div>
    </section>

    {{-- Valeurs --}}
    <section class="bg-itf-cream py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Nos valeurs</h2>
            <div class="grid sm:grid-cols-3 gap-6">
                @foreach ($valeurs as $valeur)
                    <div class="bg-itf-white rounded-xl p-6 text-center shadow">
                        <span class="text-4xl">{{ $valeur['icone'] }}</span>
                        <h3 class="font-bold text-itf-dark mt-3 mb-2">{{ $valeur['titre'] }}</h3>
                        <p class="text-sm text-gray-600">{{ $valeur['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Historique / engagement --}}
    <section class="max-w-4xl mx-auto px-4 py-16">
        <h2 class="text-2xl font-bold text-itf-dark mb-4 text-center">Notre engagement</h2>
        <p class="text-gray-700 leading-relaxed text-center">
            Depuis sa création, ITF a accompagné plusieurs promotions d'étudiants de l'UFR Sciences de la Nature,
            avec un objectif constant : donner à chacun les moyens de réussir dès sa première année à l'université.
            Cours structurés, exercices corrigés, quiz interactifs et suivi individuel sont au cœur de notre
            démarche pédagogique.
        </p>
        <div class="text-center mt-10">
            <a href="{{ route('inscription') }}"
               class="inline-block bg-itf-blue text-itf-white font-bold px-8 py-4 rounded-lg hover:opacity-90 transition">
                S'inscrire — 1 mois gratuit
            </a>
        </div>
    </section>
</x-app-layout>
