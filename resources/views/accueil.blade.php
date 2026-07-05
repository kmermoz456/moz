<x-app-layout
    title="ITF — Renforcement académique en Sciences de la Nature (UNA)"
    description="Intellect Tronc SN Formation accompagne les étudiants de Licence 1 et Licence 2 en Sciences de la Nature de l'Université Nangui Abrogoua : cours, quiz, exercices corrigés et suivi personnalisé. 1 mois gratuit pour les nouveaux bacheliers.">

    {{-- Petites animations locales à la page (aucune dépendance) --}}
    <style>
        [x-cloak] { display: none !important; }

        @keyframes itf-flottement {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        .itf-flotte { animation: itf-flottement 6s ease-in-out infinite; }

        .itf-reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .6s ease, transform .6s ease;
        }
        .itf-reveal.est-visible { opacity: 1; transform: translateY(0); }

        @media (prefers-reduced-motion: reduce) {
            .itf-flotte { animation: none; }
            .itf-reveal { opacity: 1; transform: none; transition: none; }
        }
    </style>

    {{-- ================= Bannière avec image ================= --}}
    <section class="relative overflow-hidden bg-white">

        {{-- Image de fond : ancrée à droite pour garder les étudiants visibles --}}
        <img src="{{ asset('images/banner.png') }}"
             alt="Étudiants d'Intellect Tronc SN Formation sur le campus"
             class="absolute inset-0 h-full w-full object-cover object-right">

        {{-- Voile dégradé : garantit la lisibilité du texte, surtout sur mobile --}}
        <div aria-hidden="true"
             class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-white/10 sm:via-white/70 sm:to-transparent"></div>

        <div class="relative mx-auto max-w-6xl px-4 py-24 sm:py-32 lg:py-40">
            <div class="max-w-xl">

                {{-- Badge d'urgence --}}
                <p class="inline-flex items-center gap-2 rounded-full border border-itf-blue/30 bg-white/80 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-itf-blue shadow-sm backdrop-blur">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-itf-blue opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-itf-blue"></span>
                    </span>
                    Inscriptions ouvertes — 1 mois gratuit
                </p>

                <h1 class="mt-6 text-4xl font-extrabold leading-[1.1] tracking-tight text-itf-dark sm:text-6xl">
                    Réussissez votre Licence 1 &amp; 2 en
                    <span class="text-itf-blue">Sciences de la Nature</span>
                </h1>

                <p class="mt-6 text-lg leading-relaxed text-gray-700">
                    Intellect Tronc SN Formation accompagne les étudiants de l'UFR Sciences de la Nature de
                    l'Université Nangui Abrogoua vers la réussite, avec un suivi personnalisé et des supports de qualité.
                </p>

                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('inscription') }}"
                       class="group inline-flex items-center justify-center gap-2 rounded-xl bg-itf-blue px-8 py-4 text-lg font-bold text-itf-white shadow-lg shadow-itf-blue/30 transition hover:-translate-y-0.5 hover:shadow-xl">
                        S'inscrire — 1 mois gratuit
                        <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 6l6 6-6 6M5 12h14"/>
                        </svg>
                    </a>
                    <a href="{{ route('pourquoi') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-itf-blue/40 bg-white/70 px-8 py-4 text-lg font-semibold text-itf-blue backdrop-blur transition hover:border-itf-blue hover:bg-white">
                        Pourquoi choisir ITF ?
                    </a>
                </div>

                {{-- Repères de confiance : 11 ans d'expérience mis en avant --}}
                <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm font-semibold text-itf-dark">
                    <span class="inline-flex items-center gap-2.5 rounded-full bg-white/80 py-1.5 pl-1.5 pr-4 shadow-sm backdrop-blur">
                        <span class="grid h-9 w-9 place-items-center rounded-full bg-itf-blue text-sm font-extrabold text-itf-white">11</span>
                        ans d'expérience
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="text-itf-blue">✔</span> Suivi personnalisé
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="text-itf-blue">✔</span> Enseignants expérimentés
                    </span>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= Présentation ================= --}}
    <section class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="itf-reveal">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">À propos de nous</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Qui sommes-nous ?</h2>
                <div class="mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
                <p class="mt-5 leading-relaxed text-gray-700">
                    Depuis 11 ans, ITF est la structure de renforcement académique dédiée aux étudiants de Licence 1
                    et Licence 2 en Sciences de la Nature. Nous proposons des cours de soutien, des exercices corrigés,
                    des examens blancs et des quiz interactifs pour maximiser vos chances de réussite dès le premier
                    semestre à l'université.
                </p>
                <a href="{{ route('pourquoi') }}"
                   class="group mt-6 inline-flex items-center gap-2 font-semibold text-itf-blue">
                    Pourquoi choisir ITF ?
                    <span class="transition group-hover:translate-x-1">&rarr;</span>
                </a>
            </div>

            <div class="itf-reveal itf-flotte relative">
                <div aria-hidden="true" class="absolute -inset-3 -z-10 rounded-3xl bg-itf-blue/10 rotate-2"></div>
                <ul class="space-y-4 rounded-3xl bg-itf-cream p-8 shadow-sm">
                    @foreach ([
                        ['🎓', 'Enseignants expérimentés'],
                        ['👥', 'Suivi personnalisé et petits groupes'],
                        ['📄', 'Cours PDF téléchargeables et quiz en ligne'],
                        ['💬', 'Assistance permanente sur WhatsApp'],
                    ] as [$icone, $texte])
                        <li class="flex items-center gap-4">
                            <span class="grid h-11 w-11 shrink-0 place-items-center rounded-xl bg-itf-blue/10 text-xl">{{ $icone }}</span>
                            <span class="font-semibold text-itf-dark">{{ $texte }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- ================= Chiffres clés (compteurs animés) ================= --}}
    <section class="relative overflow-hidden bg-itf-dark py-16 text-itf-white">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute left-1/4 top-0 h-64 w-64 -translate-y-1/2 rounded-full bg-itf-blue/30 blur-3xl"></div>
        </div>

        <div class="relative mx-auto grid max-w-6xl grid-cols-2 gap-10 px-4 text-center sm:grid-cols-4">
            @foreach ([
                [$chiffres['etudiants_formes'], '+', 'Étudiants formés'],
                [$chiffres['taux_reussite'],    '%', 'Taux de réussite'],
                [$chiffres['enseignants'],      '',  'Enseignants'],
                [$chiffres['annees'],           '',  "Années d'expérience"],
            ] as [$valeur, $suffixe, $libelle])
                <div x-data="{
                        affiche: '0',
                        init() {
                            const cible = {{ (int) $valeur }};
                            const obs = new IntersectionObserver((e) => {
                                if (!e[0].isIntersecting) return;
                                obs.disconnect();
                                const debut = performance.now();
                                const anime = (t) => {
                                    const p = Math.min((t - debut) / 1400, 1);
                                    this.affiche = Math.round(cible * (1 - Math.pow(1 - p, 3))).toLocaleString('fr-FR');
                                    if (p < 1) requestAnimationFrame(anime);
                                };
                                requestAnimationFrame(anime);
                            }, { threshold: .5 });
                            obs.observe(this.$el);
                        }
                     }">
                    <p class="text-4xl font-extrabold text-itf-cream sm:text-5xl">
                        <span x-text="affiche">0</span>{{ $suffixe }}
                    </p>
                    <p class="mt-2 text-sm font-medium text-gray-300">{{ $libelle }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= Témoignages (carrousel auto) ================= --}}
    @if ($temoignages->count())
        <section class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Preuve sociale</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Ce que disent nos anciens étudiants</h2>
                <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
            </div>

            <div x-data="{
                    index: 0,
                    total: {{ $temoignages->count() }},
                    timer: null,
                    suivant() { this.index = (this.index + 1) % this.total },
                    precedent() { this.index = (this.index - 1 + this.total) % this.total },
                    demarrer() { this.timer = setInterval(() => this.suivant(), 6000) },
                    stopper() { clearInterval(this.timer) },
                    init() { if (this.total > 1) this.demarrer() }
                 }"
                 @mouseenter="stopper()" @mouseleave="if (total > 1) demarrer()"
                 class="relative mx-auto mt-10 max-w-2xl">

                @foreach ($temoignages as $i => $temoignage)
                    <div x-show="index === {{ $i }}" x-cloak
                         x-transition:enter="transition duration-500"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="relative rounded-3xl bg-itf-cream p-10 pt-12 text-center shadow-sm">

                        {{-- Guillemet décoratif --}}
                        <span aria-hidden="true"
                              class="absolute -top-5 left-1/2 grid h-11 w-11 -translate-x-1/2 place-items-center rounded-full bg-itf-blue text-2xl font-extrabold text-itf-white shadow">
                            &ldquo;
                        </span>

                        @if ($temoignage->photo)
                            <img src="{{ asset('storage/'.$temoignage->photo) }}" alt="{{ $temoignage->nom }}"
                                 class="mx-auto mb-5 h-16 w-16 rounded-full border-4 border-itf-white object-cover shadow">
                        @else
                            <span class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-full border-4 border-itf-white bg-itf-blue text-2xl font-bold text-itf-white shadow">
                                {{ mb_strtoupper(mb_substr($temoignage->nom, 0, 1)) }}
                            </span>
                        @endif

                        <p class="text-lg italic leading-relaxed text-itf-dark">&laquo; {{ $temoignage->contenu }} &raquo;</p>
                        <p class="mt-5 font-bold text-itf-blue">{{ $temoignage->nom }}</p>
                        @if ($temoignage->promotion)
                            <p class="text-sm text-gray-500">{{ $temoignage->promotion }}</p>
                        @endif
                    </div>
                @endforeach

                @if ($temoignages->count() > 1)
                    {{-- Flèches --}}
                    <button @click="precedent()" aria-label="Témoignage précédent"
                            class="absolute -left-4 top-1/2 hidden h-10 w-10 -translate-y-1/2 place-items-center rounded-full bg-itf-white text-itf-blue shadow-md transition hover:bg-itf-blue hover:text-itf-white sm:grid lg:-left-14">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="suivant()" aria-label="Témoignage suivant"
                            class="absolute -right-4 top-1/2 hidden h-10 w-10 -translate-y-1/2 place-items-center rounded-full bg-itf-white text-itf-blue shadow-md transition hover:bg-itf-blue hover:text-itf-white sm:grid lg:-right-14">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>

                    {{-- Points --}}
                    <div class="mt-6 flex justify-center gap-2">
                        @foreach ($temoignages as $i => $temoignage)
                            <button @click="index = {{ $i }}" aria-label="Voir le témoignage {{ $i + 1 }}"
                                    :class="index === {{ $i }} ? 'bg-itf-blue w-6' : 'bg-gray-300 w-2.5 hover:bg-gray-400'"
                                    class="h-2.5 rounded-full transition-all duration-300"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ================= Actualités ================= --}}
    @if ($actualites->count())
        <section class="bg-itf-cream py-16 sm:py-20">
            <div class="mx-auto max-w-6xl px-4">
                <div class="text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Quoi de neuf ?</p>
                    <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Dernières actualités</h2>
                    <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
                </div>

                <div class="mt-10 grid gap-6 sm:grid-cols-3">
                    @foreach ($actualites as $actualite)
                        <article class="itf-reveal group flex flex-col overflow-hidden rounded-2xl bg-itf-white shadow transition duration-300 hover:-translate-y-1.5 hover:shadow-xl">
                            <div class="relative h-44 overflow-hidden">
                                @if ($actualite->image)
                                    <img src="{{ asset('storage/'.$actualite->image) }}" alt="{{ $actualite->titre }}"
                                         class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                @else
                                    <div class="grid h-full w-full place-items-center bg-itf-blue/90 text-5xl">📰</div>
                                @endif
                                <span class="absolute left-3 top-3 rounded-full bg-itf-white/95 px-3 py-1 text-xs font-bold text-itf-blue shadow-sm">
                                    {{ $actualite->created_at->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="font-bold leading-snug text-itf-dark transition group-hover:text-itf-blue">
                                    {{ $actualite->titre }}
                                </h3>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-gray-600 line-clamp-3">
                                    {{ Str::limit($actualite->contenu, 120) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ================= Galerie ================= --}}
    @if ($galerie->count())
        <section class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">En images</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Galerie photos</h2>
                <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
            </div>

            <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ($galerie as $photo)
                    <figure class="group relative overflow-hidden rounded-xl {{ $loop->iteration % 5 === 1 ? 'row-span-2' : '' }}">
                        <img src="{{ asset('storage/'.$photo->image) }}" alt="{{ $photo->titre }}"
                             class="h-full min-h-32 w-full object-cover transition duration-500 group-hover:scale-110">
                        <figcaption class="absolute inset-0 flex items-end bg-gradient-to-t from-itf-dark/80 via-transparent to-transparent p-3 opacity-0 transition duration-300 group-hover:opacity-100">
                            <span class="text-sm font-semibold text-itf-white">{{ $photo->titre }}</span>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ================= Appel final ================= --}}
    <section class="bg-itf-blue py-16 text-center text-itf-white">
        <div class="mx-auto max-w-3xl px-4">
            <h2 class="text-3xl font-extrabold sm:text-4xl">Prêt(e) à réussir votre Licence ?</h2>
            <p class="mx-auto mt-4 max-w-xl text-itf-cream/90">
                Depuis 11 ans, ITF aide les étudiants à prendre de l'avance. Votre premier mois est offert.
            </p>
            <a href="{{ route('inscription') }}"
               class="mt-8 inline-block rounded-xl bg-itf-cream px-10 py-4 text-lg font-bold text-itf-dark shadow-lg shadow-black/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                S'inscrire — 1 mois gratuit
            </a>
        </div>
    </section>

    {{-- Révélation au scroll (script local, aucune dépendance) --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((e) => {
                    if (e.isIntersecting) {
                        e.target.classList.add('est-visible');
                        obs.unobserve(e.target);
                    }
                });
            }, { threshold: 0.15 });
            document.querySelectorAll('.itf-reveal').forEach((el) => obs.observe(el));
        });
    </script>

</x-app-layout>