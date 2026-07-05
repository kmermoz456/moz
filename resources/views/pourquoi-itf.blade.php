<x-app-layout>

    {{-- Animations locales (identiques à l'accueil, aucune dépendance) --}}
    <style>
        .itf-reveal {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity .6s ease, transform .6s ease;
        }
        .itf-reveal.est-visible { opacity: 1; transform: translateY(0); }

        @media (prefers-reduced-motion: reduce) {
            .itf-reveal { opacity: 1; transform: none; transition: none; }
        }
    </style>

    {{-- ================= En-tête ================= --}}
    <section class="relative overflow-hidden bg-itf-blue py-20 text-itf-white sm:py-24">
        {{-- Décor : halos + points, comme sur l'accueil --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-24 -top-24 h-80 w-80 rounded-full bg-itf-cream/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -right-16 h-96 w-96 rounded-full bg-itf-white/10 blur-3xl"></div>
            <svg class="absolute left-8 bottom-8 hidden h-32 w-32 text-itf-cream/20 lg:block" fill="currentColor" viewBox="0 0 100 100">
                @for ($x = 0; $x < 8; $x++) @for ($y = 0; $y < 8; $y++)
                    <circle cx="{{ 6 + $x * 12 }}" cy="{{ 6 + $y * 12 }}" r="1.6" />
                @endfor @endfor
            </svg>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 text-center">
            <p class="mx-auto inline-flex items-center gap-2 rounded-full border border-itf-cream/40 bg-itf-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-itf-cream backdrop-blur">
                Nos atouts
            </p>
            <h1 class="mt-5 text-4xl font-extrabold tracking-tight sm:text-5xl">
                Pourquoi choisir <span class="relative inline-block">
                    <span class="relative z-10">ITF</span>
                    <span aria-hidden="true" class="absolute inset-x-0 bottom-1 z-0 h-3 -rotate-1 rounded bg-itf-cream/30"></span>
                </span> ?
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-itf-cream/90">
                Tout ce que nous mettons en place pour maximiser votre réussite en Licence 1 et Licence 2.
            </p>
        </div>

        {{-- Vague de transition --}}
        <svg aria-hidden="true" class="absolute bottom-0 left-0 block w-full text-itf-white" viewBox="0 0 1440 48" fill="currentColor" preserveAspectRatio="none">
            <path d="M0 48h1440V24C1200 6 960 0 720 9 480 18 240 36 0 30Z"/>
        </svg>
    </section>

    {{-- ================= Avantages ================= --}}
    <section class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($avantages as $avantage)
                <article class="itf-reveal group relative overflow-hidden rounded-2xl border border-gray-200 bg-itf-white p-7 transition duration-300 hover:-translate-y-1.5 hover:border-itf-blue/30 hover:shadow-xl"
                         style="transition-delay: {{ ($loop->index % 3) * 100 }}ms">

                    {{-- Liseré supérieur qui se déploie au survol --}}
                    <span aria-hidden="true"
                          class="absolute inset-x-0 top-0 h-1 origin-left scale-x-0 bg-itf-blue transition-transform duration-300 group-hover:scale-x-100"></span>

                    {{-- Numéro discret en fond --}}
                    <span aria-hidden="true"
                          class="pointer-events-none absolute -right-2 -top-4 text-7xl font-extrabold text-itf-blue/5 transition group-hover:text-itf-blue/10">
                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </span>

                    <span class="grid h-14 w-14 place-items-center rounded-2xl bg-itf-cream text-3xl transition duration-300 group-hover:scale-110 group-hover:bg-itf-blue/10">
                        {{ $avantage['icone'] }}
                    </span>

                    <h3 class="mt-4 text-lg font-bold text-itf-dark transition group-hover:text-itf-blue">
                        {{ $avantage['titre'] }}
                    </h3>
                    <p class="mt-2 text-sm leading-relaxed text-gray-600">
                        {{ $avantage['description'] }}
                    </p>
                </article>
            @endforeach
        </div>
    </section>

    {{-- ================= Appel final ================= --}}
    <section class="relative overflow-hidden bg-itf-cream py-16">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute right-1/4 top-0 h-56 w-56 -translate-y-1/2 rounded-full bg-itf-blue/10 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-3xl px-4 text-center">
            <h2 class="text-3xl font-extrabold text-itf-dark sm:text-4xl">
                Convaincu(e) ? Passez à l'action.
            </h2>
            <p class="mx-auto mt-4 max-w-xl text-gray-700">
                Testez ITF gratuitement pendant un mois complet et constatez la différence par vous-même.
            </p>
            <a href="{{ route('inscription') }}"
               class="group mt-8 inline-flex items-center gap-2 rounded-xl bg-itf-blue px-10 py-4 text-lg font-bold text-itf-white shadow-lg shadow-itf-blue/30 transition hover:-translate-y-0.5 hover:shadow-xl">
                S'inscrire — 1 mois gratuit
                <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 6l6 6-6 6M5 12h14"/>
                </svg>
            </a>
            <p class="mt-4 text-xs text-gray-500">Sans engagement — décidez à la fin du mois offert.</p>
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
            }, { threshold: 0.15 });
            document.querySelectorAll('.itf-reveal').forEach((el) => obs.observe(el));
        });
    </script>

</x-app-layout>