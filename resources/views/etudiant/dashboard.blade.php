<x-app-layout title="Mon espace — ITF" :noindex="true">

    <style>
        .itf-reveal {
            opacity: 0;
            transform: translateY(14px);
            transition: opacity .5s ease, transform .5s ease;
        }
        .itf-reveal.est-visible { opacity: 1; transform: translateY(0); }
        @media (prefers-reduced-motion: reduce) {
            .itf-reveal { opacity: 1; transform: none; transition: none; }
        }
    </style>

    {{-- ================= En-tête de l'espace ================= --}}
    <section class="relative overflow-hidden bg-itf-blue text-itf-white">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-itf-cream/10 blur-3xl"></div>
        </div>

        <div class="relative mx-auto flex max-w-6xl flex-col gap-4 px-4 py-10 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                {{-- Avatar avec initiales --}}
                <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-itf-cream text-xl font-extrabold text-itf-dark shadow">
                    {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1) . mb_substr(auth()->user()->prenoms, 0, 1)) }}
                </span>
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-itf-cream/80">Mon espace</p>
                    <h1 class="text-xl font-extrabold sm:text-2xl">
                        {{ auth()->user()->name }} {{ auth()->user()->prenoms }}
                    </h1>
                </div>
            </div>

            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-itf-white/10 px-4 py-2 text-sm font-bold backdrop-blur">
                🎓 Niveau {{ auth()->user()->niveau }}
            </span>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10">

        {{-- ================= Bandeau statut essai ================= --}}
        @if (auth()->user()->essaiActif())
            @php
                $finEssai = \Illuminate\Support\Carbon::parse(auth()->user()->essai_fin);
                $joursRestants = (int) max(0, now()->startOfDay()->diffInDays($finEssai->copy()->startOfDay()));
            @endphp
            <div class="mb-10 flex flex-col gap-4 rounded-2xl border border-green-200 bg-green-50 p-6 sm:flex-row sm:items-center">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-green-100 text-2xl">🎁</span>
                <div class="flex-1">
                    <p class="font-bold text-green-900">Votre mois d'essai gratuit est actif</p>
                    <p class="mt-1 text-sm text-green-800">
                        Accès complet à tous les cours de votre niveau jusqu'au
                        <strong>{{ $finEssai->translatedFormat('d F Y') }}</strong>.
                    </p>
                </div>
                <span class="inline-flex w-fit shrink-0 items-center gap-2 rounded-full bg-green-600 px-4 py-2 text-sm font-extrabold text-white">
                    ⏳ {{ $joursRestants }} {{ $joursRestants > 1 ? 'jours restants' : 'jour restant' }}
                </span>
            </div>
        @else
            <div class="mb-10 flex flex-col gap-4 rounded-2xl border border-amber-200 bg-amber-50 p-6 sm:flex-row sm:items-center">
                <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-amber-100 text-2xl">🔒</span>
                <div class="flex-1">
                    <p class="font-bold text-amber-900">Votre mois d'essai gratuit est terminé</p>
                    <p class="mt-1 text-sm text-amber-800">
                        Seuls les cours gratuits restent accessibles tant qu'aucun paiement n'est validé
                        pour le mois en cours.
                    </p>
                </div>
                {{-- Lien WhatsApp : ajustez la clé de config ou l'URL selon votre projet --}}
                <a href="{{ config('intellecttronc.whatsapp_group', 'https://wa.me/225XXXXXXXXXX') }}"
                   target="_blank" rel="noopener"
                   class="inline-flex w-fit shrink-0 items-center gap-2 rounded-xl bg-amber-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-amber-700">
                    💬 Régulariser sur WhatsApp
                </a>
            </div>
        @endif

        {{-- ================= Accès rapide ================= --}}
        <div class="mb-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('etudiant.quiz.index') }}"
               class="group flex items-center gap-4 rounded-2xl bg-itf-blue p-6 text-itf-white shadow-lg shadow-itf-blue/20 transition hover:-translate-y-1 hover:shadow-xl">
                <span class="grid h-14 w-14 shrink-0 place-items-center rounded-xl bg-itf-white/15 text-3xl transition group-hover:scale-110">⚡</span>
                <span>
                    <span class="block text-lg font-extrabold">Faire un quiz</span>
                    <span class="block text-sm text-itf-cream/85">Testez vos connaissances dès maintenant</span>
                </span>
                <svg class="ml-auto h-6 w-6 shrink-0 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 6l6 6-6 6M5 12h14"/>
                </svg>
            </a>

            <a href="#mes-cours"
               class="group flex items-center gap-4 rounded-2xl border-2 border-itf-blue/20 bg-itf-cream p-6 text-itf-dark transition hover:-translate-y-1 hover:border-itf-blue/40 hover:shadow-lg">
                <span class="grid h-14 w-14 shrink-0 place-items-center rounded-xl bg-itf-blue/10 text-3xl transition group-hover:scale-110">📚</span>
                <span>
                    <span class="block text-lg font-extrabold">Mes cours</span>
                    <span class="block text-sm text-gray-600">Retrouvez tous vos supports PDF</span>
                </span>
                <svg class="ml-auto h-6 w-6 shrink-0 text-itf-blue transition group-hover:translate-y-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7-7-7M12 21V3"/>
                </svg>
            </a>

            <a href="{{ route('etudiant.documents.index') }}"
               class="group flex items-center gap-4 rounded-2xl border-2 border-itf-blue/20 bg-itf-cream p-6 text-itf-dark transition hover:-translate-y-1 hover:border-itf-blue/40 hover:shadow-lg">
                <span class="grid h-14 w-14 shrink-0 place-items-center rounded-xl bg-itf-blue/10 text-3xl transition group-hover:scale-110">📦</span>
                <span>
                    <span class="block text-lg font-extrabold">Commander des documents</span>
                    <span class="block text-sm text-gray-600">Recueils, fiches et livrets papier</span>
                </span>
                <svg class="ml-auto h-6 w-6 shrink-0 text-itf-blue transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 6l6 6-6 6M5 12h14"/>
                </svg>
            </a>
        </div>

        {{-- ================= Cours par matière ================= --}}
        <div id="mes-cours" class="scroll-mt-24">
            <div class="mb-8 flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Supports de cours</p>
                    <h2 class="mt-1 text-2xl font-extrabold text-itf-dark">Mes cours — Niveau {{ auth()->user()->niveau }}</h2>
                </div>
            </div>

            @forelse ($cours as $matiere => $coursMatiere)
                <div class="mb-10">
                    {{-- En-tête de matière --}}
                    <div class="mb-4 flex items-center gap-3">
                        <h3 class="text-lg font-bold text-itf-blue">{{ $matiere }}</h3>
                        <span class="rounded-full bg-itf-cream px-3 py-0.5 text-xs font-bold text-itf-dark">
                            {{ $coursMatiere->count() }} {{ $coursMatiere->count() > 1 ? 'cours' : 'cours' }}
                        </span>
                        <div aria-hidden="true" class="h-px flex-1 bg-gray-200"></div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($coursMatiere as $item)
                            @php $accessible = $item->gratuit || $accesComplet; @endphp

                            <div class="itf-reveal group relative flex flex-col rounded-2xl border p-5 transition duration-300
                                        {{ $accessible
                                            ? 'border-gray-200 bg-itf-white hover:-translate-y-1 hover:border-itf-blue/30 hover:shadow-lg'
                                            : 'border-gray-200 bg-gray-50' }}"
                                 style="transition-delay: {{ ($loop->index % 3) * 70 }}ms">

                                <div class="flex items-start justify-between gap-3">
                                    <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl text-xl
                                                 {{ $accessible ? 'bg-itf-cream' : 'bg-gray-200 grayscale' }}">
                                        📄
                                    </span>
                                    @if ($item->gratuit)
                                        <span class="rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-bold text-green-700">Gratuit</span>
                                    @elseif (! $accessible)
                                        <span class="rounded-full bg-gray-200 px-2.5 py-0.5 text-xs font-bold text-gray-500">🔒 Verrouillé</span>
                                    @endif
                                </div>

                                <h4 class="mt-3 font-bold {{ $accessible ? 'text-itf-dark' : 'text-gray-400' }}">
                                    {{ $item->titre }}
                                </h4>

                                @if ($item->description)
                                    <p class="mt-1.5 flex-1 text-sm leading-relaxed {{ $accessible ? 'text-gray-600' : 'text-gray-400' }}">
                                        {{ $item->description }}
                                    </p>
                                @endif

                                @if ($accessible)
                                    <a href="{{ route('cours.telecharger', $item) }}"
                                       class="mt-4 inline-flex items-center gap-2 rounded-xl bg-itf-blue/10 px-4 py-2.5 text-sm font-bold text-itf-blue transition group-hover:bg-itf-blue group-hover:text-itf-white">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v3a1 1 0 001 1h14a1 1 0 001-1v-3M12 4v12m0 0l-4-4m4 4l4-4"/>
                                        </svg>
                                        Télécharger le PDF
                                    </a>
                                @else
                                    <p class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-gray-400">
                                        Accès réservé — essai terminé
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                {{-- État vide --}}
                <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-itf-cream/40 p-12 text-center">
                    <span class="text-5xl">📭</span>
                    <p class="mt-4 font-bold text-itf-dark">Aucun cours disponible pour le moment</p>
                    <p class="mx-auto mt-1 max-w-sm text-sm text-gray-600">
                        Les supports de votre niveau ({{ auth()->user()->niveau }}) seront ajoutés très bientôt.
                        Revenez régulièrement ou surveillez les annonces sur WhatsApp.
                    </p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Révélation au scroll --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) {
                        e.target.classList.add('est-visible');
                        obs.unobserve(e.target);
                    }
                });
            }, { threshold: 0.1 });
            document.querySelectorAll('.itf-reveal').forEach((el) => obs.observe(el));
        });
    </script>

</x-app-layout>