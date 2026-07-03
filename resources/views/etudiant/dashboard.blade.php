<x-app-layout>
    <section class="max-w-6xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold text-itf-dark mb-6">Mon espace — {{ auth()->user()->name }} {{ auth()->user()->prenoms }}</h1>

        {{-- Bandeau statut essai --}}
        @if (auth()->user()->essaiActif())
            <div class="bg-green-50 border border-green-300 text-green-800 rounded-lg p-4 mb-8">
                🎁 Votre mois d'essai gratuit est actif jusqu'au
                <strong>{{ \Illuminate\Support\Carbon::parse(auth()->user()->essai_fin)->translatedFormat('d F Y') }}</strong>.
                Vous avez accès à tous les cours de votre niveau.
            </div>
        @else
            <div class="bg-amber-50 border border-amber-300 text-amber-800 rounded-lg p-4 mb-8">
                Votre mois d'essai gratuit est terminé. Seuls les cours gratuits restent accessibles tant qu'aucun
                paiement n'est validé pour le mois en cours. Contactez ITF sur WhatsApp pour régulariser votre accès.
            </div>
        @endif

        {{-- Accès rapide quiz --}}
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="{{ route('etudiant.quiz.index') }}"
               class="bg-itf-blue text-itf-white font-semibold px-5 py-3 rounded-lg hover:opacity-90 transition">
                ⚡ Faire un quiz
            </a>
        </div>

        {{-- Cours par matière --}}
        <h2 class="text-xl font-bold text-itf-dark mb-4">Mes cours — Niveau {{ auth()->user()->niveau }}</h2>

        @forelse ($cours as $matiere => $coursMatiere)
            <div class="mb-8">
                <h3 class="font-semibold text-itf-blue mb-3">{{ $matiere }}</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($coursMatiere as $item)
                        <div class="border border-gray-200 rounded-xl p-5">
                            <div class="flex items-start justify-between gap-2">
                                <h4 class="font-bold text-itf-dark">{{ $item->titre }}</h4>
                                @if ($item->gratuit)
                                    <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Gratuit</span>
                                @endif
                            </div>
                            @if ($item->description)
                                <p class="text-sm text-gray-600 mt-2">{{ $item->description }}</p>
                            @endif

                            @if ($item->gratuit || $accesComplet)
                                <a href="{{ route('cours.telecharger', $item) }}"
                                   class="inline-block mt-4 text-sm font-semibold text-itf-blue hover:underline">
                                    📄 Télécharger le PDF
                                </a>
                            @else
                                <p class="mt-4 text-sm text-gray-400">🔒 Accès réservé (essai terminé)</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-gray-500">Aucun cours disponible pour le moment pour votre niveau.</p>
        @endforelse
    </section>
</x-app-layout>
