<x-app-layout>
    {{-- Bannière --}}
    <section class="bg-itf-blue text-itf-white">
        <div class="max-w-6xl mx-auto px-4 py-20 text-center">
            <h1 class="text-3xl sm:text-5xl font-extrabold leading-tight">
                Réussissez votre Licence 1 &amp; 2<br class="hidden sm:block"> en Sciences de la Nature
            </h1>
            <p class="mt-4 text-lg text-itf-cream max-w-2xl mx-auto">
                Intellect Tronc SN Formation accompagne les étudiants de l'UFR Sciences de la Nature de
                l'Université Nangui Abrogoua vers la réussite, avec un suivi personnalisé et des supports de qualité.
            </p>
            <a href="{{ route('inscription') }}"
               class="inline-block mt-8 bg-itf-cream text-itf-dark font-bold px-8 py-4 rounded-lg text-lg hover:opacity-90 transition">
                S'inscrire — 1 mois gratuit
            </a>
        </div>
    </section>

    {{-- Présentation --}}
    <section class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="text-2xl font-bold text-itf-dark mb-4">Qui sommes-nous ?</h2>
                <p class="text-gray-700 leading-relaxed">
                    ITF est une structure de renforcement académique dédiée aux étudiants de Licence 1 et Licence 2
                    en Sciences de la Nature. Nous proposons des cours de soutien, des exercices corrigés, des
                    examens blancs et des quiz interactifs pour maximiser vos chances de réussite dès le premier
                    semestre à l'université.
                </p>
                <a href="{{ route('pourquoi') }}" class="inline-block mt-4 text-itf-blue font-semibold hover:underline">
                    Pourquoi choisir ITF ? &rarr;
                </a>
            </div>
            <div class="bg-itf-cream rounded-2xl p-8">
                <ul class="space-y-3 text-itf-dark">
                    <li class="flex items-center gap-2">✅ Enseignants expérimentés</li>
                    <li class="flex items-center gap-2">✅ Suivi personnalisé et petits groupes</li>
                    <li class="flex items-center gap-2">✅ Cours PDF téléchargeables et quiz en ligne</li>
                    <li class="flex items-center gap-2">✅ Assistance permanente sur WhatsApp</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- Chiffres clés --}}
    <section class="bg-itf-dark text-itf-white py-14">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-2 sm:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-4xl font-extrabold text-itf-cream">{{ $chiffres['etudiants_formes'] }}+</p>
                <p class="text-sm text-gray-300 mt-1">Étudiants formés</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold text-itf-cream">{{ $chiffres['taux_reussite'] }}%</p>
                <p class="text-sm text-gray-300 mt-1">Taux de réussite</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold text-itf-cream">{{ $chiffres['enseignants'] }}</p>
                <p class="text-sm text-gray-300 mt-1">Enseignants</p>
            </div>
            <div>
                <p class="text-4xl font-extrabold text-itf-cream">{{ $chiffres['annees'] }}</p>
                <p class="text-sm text-gray-300 mt-1">Années d'expérience</p>
            </div>
        </div>
    </section>

    {{-- Témoignages --}}
    @if ($temoignages->count())
        <section class="max-w-6xl mx-auto px-4 py-16">
            <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Ce que disent nos anciens étudiants</h2>

            <div x-data="{ index: 0, total: {{ $temoignages->count() }} }" class="relative max-w-2xl mx-auto">
                @foreach ($temoignages as $i => $temoignage)
                    <div x-show="index === {{ $i }}" x-cloak
                         class="bg-itf-cream rounded-2xl p-8 text-center">
                        @if ($temoignage->photo)
                            <img src="{{ asset('storage/'.$temoignage->photo) }}" alt="{{ $temoignage->nom }}"
                                 class="w-16 h-16 rounded-full mx-auto mb-4 object-cover">
                        @endif
                        <p class="text-itf-dark italic">&laquo; {{ $temoignage->contenu }} &raquo;</p>
                        <p class="mt-4 font-semibold text-itf-blue">{{ $temoignage->nom }}</p>
                        @if ($temoignage->promotion)
                            <p class="text-sm text-gray-500">{{ $temoignage->promotion }}</p>
                        @endif
                    </div>
                @endforeach

                @if ($temoignages->count() > 1)
                    <div class="flex justify-center gap-2 mt-6">
                        @foreach ($temoignages as $i => $temoignage)
                            <button @click="index = {{ $i }}"
                                    :class="index === {{ $i }} ? 'bg-itf-blue' : 'bg-gray-300'"
                                    class="w-2.5 h-2.5 rounded-full transition"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Actualités --}}
    @if ($actualites->count())
        <section class="bg-itf-cream py-16">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Dernières actualités</h2>
                <div class="grid sm:grid-cols-3 gap-6">
                    @foreach ($actualites as $actualite)
                        <div class="bg-itf-white rounded-xl overflow-hidden shadow">
                            @if ($actualite->image)
                                <img src="{{ asset('storage/'.$actualite->image) }}" alt="{{ $actualite->titre }}"
                                     class="w-full h-40 object-cover">
                            @endif
                            <div class="p-5">
                                <h3 class="font-bold text-itf-dark mb-2">{{ $actualite->titre }}</h3>
                                <p class="text-sm text-gray-600 line-clamp-3">{{ Str::limit($actualite->contenu, 120) }}</p>
                                <p class="text-xs text-gray-400 mt-3">{{ $actualite->created_at->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Galerie --}}
    @if ($galerie->count())
        <section class="max-w-6xl mx-auto px-4 py-16">
            <h2 class="text-2xl font-bold text-itf-dark mb-8 text-center">Galerie photos</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach ($galerie as $photo)
                    <img src="{{ asset('storage/'.$photo->image) }}" alt="{{ $photo->titre }}"
                         class="w-full h-32 object-cover rounded-lg">
                @endforeach
            </div>
        </section>
    @endif
</x-app-layout>
