<x-app-layout>

    <style>
        .itf-reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .6s ease, transform .6s ease;
        }
        .itf-reveal.est-visible { opacity: 1; transform: translateY(0); }

        /* Barres du graphique : poussent quand elles entrent à l'écran */
        .itf-barre {
            height: 0;
            transition: height 1.2s cubic-bezier(.22, 1, .36, 1);
        }

        @media (prefers-reduced-motion: reduce) {
            .itf-reveal { opacity: 1; transform: none; transition: none; }
            .itf-barre { transition: none; }
        }
    </style>

    {{-- ================= Bannière ================= --}}
    <section class="relative overflow-hidden bg-itf-blue text-itf-white">
        <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?auto=format&fit=crop&w=1600&q=60"
             alt="" class="absolute inset-0 h-full w-full object-cover opacity-25">
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-itf-blue/50 via-itf-blue/70 to-itf-blue"></div>

        <div class="relative mx-auto max-w-6xl px-4 py-20 text-center sm:py-24">
            <p class="mx-auto inline-flex items-center gap-2 rounded-full border border-itf-cream/40 bg-itf-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-itf-cream backdrop-blur">
                La preuve par les chiffres
            </p>
            <h1 class="mt-5 text-4xl font-extrabold tracking-tight sm:text-5xl">
                Nos statistiques et résultats
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-itf-cream/90">
                Des chiffres qui témoignent de notre engagement envers la réussite de nos étudiants.
            </p>
        </div>

        <svg aria-hidden="true" class="absolute bottom-0 left-0 block w-full text-itf-white" viewBox="0 0 1440 48" fill="currentColor" preserveAspectRatio="none">
            <path d="M0 48h1440V24C1200 6 960 0 720 9 480 18 240 36 0 30Z"/>
        </svg>
    </section>

    {{-- ================= Chiffres clés (compteurs animés) ================= --}}
    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid grid-cols-2 gap-6 text-center sm:grid-cols-4 sm:gap-8">
            @foreach ([
                ['🎓', $chiffres['etudiants_formes'],   '+', 'Étudiants formés'],
                ['📚', $chiffres['etudiants_actifs'],   '',  'Étudiants actuellement inscrits'],
                ['🏆', $chiffres['taux_reussite'],      '%', 'Taux de réussite'],
                ['💚', $chiffres['taux_satisfaction'],  '%', 'Taux de satisfaction'],
            ] as [$icone, $valeur, $suffixe, $libelle])
                <div class="itf-reveal group rounded-2xl bg-itf-cream p-6 transition duration-300 hover:-translate-y-1.5 hover:shadow-xl sm:p-8"
                     style="transition-delay: {{ ($loop->index % 4) * 80 }}ms"
                     x-data="{
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
                    <span class="text-3xl transition duration-300 group-hover:scale-125 inline-block">{{ $icone }}</span>
                    <p class="mt-3 text-4xl font-extrabold text-itf-blue sm:text-5xl">
                        <span x-text="affiche">0</span>{{ $suffixe }}
                    </p>
                    <p class="mt-2 text-sm font-medium text-itf-dark">{{ $libelle }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= Évolution annuelle ================= --}}
    <section class="bg-itf-cream py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Progression</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Évolution annuelle du taux de réussite</h2>
                <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
            </div>

            <div class="mt-10 rounded-2xl bg-itf-white p-6 shadow-sm sm:p-10">
                {{-- Lignes de repère + barres --}}
                <div class="relative">
                    {{-- Repères horizontaux (25 / 50 / 75 / 100 %) --}}
                    <div aria-hidden="true" class="pointer-events-none absolute inset-x-0 top-8 bottom-8 flex flex-col justify-between">
                        @foreach ([100, 75, 50, 25] as $repere)
                            <div class="flex items-center gap-2">
                                <span class="w-8 text-right text-[10px] text-gray-400">{{ $repere }}</span>
                                <div class="h-px flex-1 bg-gray-100"></div>
                            </div>
                        @endforeach
                    </div>

                    <div class="relative flex h-72 items-end justify-center gap-6 pl-10 sm:gap-10">
                        @foreach ($evolution as $item)
                            <div class="group flex h-full w-14 flex-col items-center sm:w-16">
                                <span class="mb-2 mt-auto font-bold {{ $loop->last ? 'text-itf-blue' : 'text-gray-500' }}">
                                    {{ $item['taux'] }}%
                                </span>
                                <div class="flex w-full flex-1 items-end" style="max-height: calc(100% - 60px)">
                                    <div class="itf-barre relative w-full rounded-t-xl {{ $loop->last ? 'bg-itf-blue' : 'bg-itf-blue/40' }} transition group-hover:bg-itf-blue"
                                         data-hauteur="{{ $item['taux'] }}%"
                                         role="img" aria-label="Taux de réussite {{ $item['annee'] }} : {{ $item['taux'] }}%">
                                        {{-- Reflet en haut de barre --}}
                                        <span aria-hidden="true" class="absolute inset-x-0 top-0 h-1.5 rounded-t-xl bg-itf-white/30"></span>
                                    </div>
                                </div>
                                <span class="mt-3 text-sm font-semibold {{ $loop->last ? 'text-itf-blue' : 'text-gray-600' }}">
                                    {{ $item['annee'] }}
                                    @if ($loop->last)
                                        <span aria-hidden="true" class="block text-center text-[10px] font-bold uppercase tracking-wider">● En cours</span>
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <p class="mt-4 text-center text-xs text-gray-500">
                Taux de réussite de nos étudiants aux examens universitaires, par année.
            </p>
        </div>
    </section>

    {{-- ================= Appel final ================= --}}
    <section class="relative overflow-hidden bg-itf-blue py-16 text-center text-itf-white">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-20 top-0 h-64 w-64 rounded-full bg-itf-cream/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -right-16 h-72 w-72 rounded-full bg-itf-white/10 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-3xl px-4">
            <h2 class="text-3xl font-extrabold sm:text-4xl">Et si le prochain chiffre, c'était vous ?</h2>
            <p class="mx-auto mt-4 max-w-xl text-itf-cream/90">
                Rejoignez les étudiants qui réussissent avec ITF. Votre premier mois est offert.
            </p>
            <a href="{{ route('inscription') }}"
               class="group mt-8 inline-flex items-center gap-2 rounded-xl bg-itf-cream px-10 py-4 text-lg font-bold text-itf-dark shadow-lg shadow-black/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                S'inscrire — 1 mois gratuit
                <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 6l6 6-6 6M5 12h14"/>
                </svg>
            </a>
        </div>
    </section>

    {{-- Révélation au scroll + animation des barres --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach((e) => {
                    if (!e.isIntersecting) return;
                    e.target.classList.add('est-visible');
                    if (e.target.dataset.hauteur) {
                        e.target.style.height = e.target.dataset.hauteur;
                    }
                    obs.unobserve(e.target);
                });
            }, { threshold: 0.15 });

            document.querySelectorAll('.itf-reveal, .itf-barre').forEach((el) => obs.observe(el));
        });
    </script>

</x-app-layout>