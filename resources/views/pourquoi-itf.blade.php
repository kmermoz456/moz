<x-app-layout>
    <section class="bg-itf-blue text-itf-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h1 class="text-3xl sm:text-4xl font-extrabold">Pourquoi choisir ITF ?</h1>
            <p class="mt-4 text-itf-cream max-w-2xl mx-auto">
                Tout ce que nous mettons en place pour maximiser votre réussite en Licence 1 et Licence 2.
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($avantages as $avantage)
                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition">
                    <span class="text-4xl">{{ $avantage['icone'] }}</span>
                    <h3 class="font-bold text-itf-dark mt-3 mb-2">{{ $avantage['titre'] }}</h3>
                    <p class="text-sm text-gray-600">{{ $avantage['description'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('inscription') }}"
               class="inline-block bg-itf-blue text-itf-white font-bold px-8 py-4 rounded-lg hover:opacity-90 transition">
                S'inscrire — 1 mois gratuit
            </a>
        </div>
    </section>
</x-app-layout>
