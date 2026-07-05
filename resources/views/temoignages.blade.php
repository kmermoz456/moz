<x-app-layout
    title="Témoignages d'étudiants — ITF"
    description="Découvrez les témoignages des étudiants de Licence 1 et Licence 2 accompagnés par Intellect Tronc SN Formation à l'Université Nangui Abrogoua.">
    {{-- Bannière --}}
    <section class="relative bg-itf-blue text-itf-white">
        <img src="https://images.unsplash.com/photo-1571260899304-425eee4c7efc?auto=format&fit=crop&w=1600&q=60"
             alt="Étudiants souriants" class="absolute inset-0 w-full h-full object-cover opacity-25">
        <div class="relative max-w-6xl mx-auto px-4 py-16 text-center">
            <h1 class="text-3xl sm:text-4xl font-extrabold">Ce que disent nos étudiants</h1>
            <p class="mt-4 text-itf-cream max-w-2xl mx-auto">
                Des témoignages authentiques d'étudiants accompagnés en Licence 1 et Licence 2 à l'UFR Sciences de
                la Nature.
            </p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 py-16">
        @if ($temoignages->count())
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($temoignages as $temoignage)
                    <div class="bg-itf-cream rounded-2xl p-8 flex flex-col">
                        <p class="text-itf-dark italic flex-1">&laquo; {{ $temoignage->contenu }} &raquo;</p>
                        <div class="flex items-center gap-3 mt-6">
                            <img src="{{ $temoignage->photo ? asset('storage/'.$temoignage->photo) : 'https://ui-avatars.com/api/?background=05668d&color=fff&name='.urlencode($temoignage->nom) }}"
                                 alt="{{ $temoignage->nom }}" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <p class="font-semibold text-itf-blue">{{ $temoignage->nom }}</p>
                                @if ($temoignage->promotion)
                                    <p class="text-xs text-gray-500">{{ $temoignage->promotion }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $temoignages->links() }}
            </div>
        @else
            <p class="text-center text-gray-500">Les premiers témoignages arrivent bientôt.</p>
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('inscription') }}"
               class="inline-block bg-itf-blue text-itf-white font-bold px-8 py-4 rounded-lg hover:opacity-90 transition">
                Rejoignez-les — 1 mois gratuit
            </a>
        </div>
    </section>
</x-app-layout>
