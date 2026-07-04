<x-app-layout>
    {{-- Bannière --}}
    <section class="relative bg-itf-blue text-itf-white">
        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=1600&q=60"
             alt="Étudiants en réussite" class="absolute inset-0 w-full h-full object-cover opacity-25">
        <div class="relative max-w-6xl mx-auto px-4 py-16 text-center">
            <h1 class="text-3xl sm:text-4xl font-extrabold">Nos statistiques et résultats</h1>
            <p class="mt-4 text-itf-cream max-w-2xl mx-auto">
                Des chiffres qui témoignent de notre engagement envers la réussite de nos étudiants.
            </p>
        </div>
    </section>

    {{-- Chiffres clés --}}
    <section class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 text-center">
            <div class="bg-itf-cream rounded-2xl p-8">
                <p class="text-4xl font-extrabold text-itf-blue">{{ $chiffres['etudiants_formes'] }}+</p>
                <p class="text-sm text-itf-dark mt-2">Étudiants formés</p>
            </div>
            <div class="bg-itf-cream rounded-2xl p-8">
                <p class="text-4xl font-extrabold text-itf-blue">{{ $chiffres['etudiants_actifs'] }}</p>
                <p class="text-sm text-itf-dark mt-2">Étudiants actuellement inscrits</p>
            </div>
            <div class="bg-itf-cream rounded-2xl p-8">
                <p class="text-4xl font-extrabold text-itf-blue">{{ $chiffres['taux_reussite'] }}%</p>
                <p class="text-sm text-itf-dark mt-2">Taux de réussite</p>
            </div>
            <div class="bg-itf-cream rounded-2xl p-8">
                <p class="text-4xl font-extrabold text-itf-blue">{{ $chiffres['taux_satisfaction'] }}%</p>
                <p class="text-sm text-itf-dark mt-2">Taux de satisfaction</p>
            </div>
        </div>
    </section>

    {{-- Évolution annuelle --}}
    <section class="bg-itf-cream py-16">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-itf-dark mb-10 text-center">Évolution annuelle du taux de réussite</h2>
            <div class="flex justify-center gap-8 h-64 bg-itf-white rounded-2xl p-8">
                @foreach ($evolution as $item)
                    <div class="flex flex-col items-center w-16">
                        <span class="font-bold text-itf-blue mb-2">{{ $item['taux'] }}%</span>
                        <div class="flex-1 w-full flex items-end">
                            <div class="w-full bg-itf-blue rounded-t-lg" style="height: {{ $item['taux'] }}%"></div>
                        </div>
                        <span class="text-sm text-gray-600 mt-2">{{ $item['annee'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-3xl mx-auto px-4 py-16 text-center">
        <h2 class="text-2xl font-bold text-itf-dark mb-4">Rejoignez les étudiants qui réussissent avec ITF</h2>
        <a href="{{ route('inscription') }}"
           class="inline-block bg-itf-blue text-itf-white font-bold px-8 py-4 rounded-lg hover:opacity-90 transition">
            S'inscrire — 1 mois gratuit
        </a>
    </section>
</x-app-layout>
