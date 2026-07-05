<x-app-layout>

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

    {{-- ================= Bannière ================= --}}
    <section class="relative overflow-hidden bg-itf-dark text-itf-white">
        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=1600&q=60"
             alt="" class="absolute inset-0 h-full w-full object-cover opacity-40">
        {{-- Dégradé pour ancrer le texte et fondre l'image --}}
        <div aria-hidden="true" class="absolute inset-0 bg-gradient-to-b from-itf-dark/40 via-itf-dark/60 to-itf-dark"></div>

        <div class="relative mx-auto max-w-6xl px-4 py-24 text-center sm:py-28">
            <p class="mx-auto inline-flex items-center gap-2 rounded-full border border-itf-cream/40 bg-itf-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-itf-cream backdrop-blur">
                Notre histoire
            </p>
            <h1 class="mt-5 text-4xl font-extrabold tracking-tight sm:text-5xl">
                À propos <span class="relative inline-block">
                    <span class="relative z-10">d'ITF</span>
                    <span aria-hidden="true" class="absolute inset-x-0 bottom-1 z-0 h-3 -rotate-1 rounded bg-itf-blue/50"></span>
                </span>
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-itf-cream/90">
                Intellect Tronc SN Formation, la référence du renforcement académique en Sciences
                de la Nature à l'Université Nangui Abrogoua.
            </p>

            {{-- Mise en avant : 11 ans d'expérience --}}
            <div class="mx-auto mt-8 inline-flex items-center gap-4 rounded-2xl border border-itf-cream/30 bg-itf-white/10 px-6 py-4 backdrop-blur">
                <span class="text-4xl font-extrabold text-itf-cream sm:text-5xl">11</span>
                <span class="text-left text-sm font-semibold leading-tight text-itf-white">
                    années d'expérience<br>
                    <span class="font-normal text-itf-cream/80">au service de la réussite des étudiants</span>
                </span>
            </div>
        </div>
    </section>

    {{-- ================= Mission & Vision ================= --}}
    <section class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
        <div class="grid gap-6 md:grid-cols-2">
            {{-- Mission : carte claire --}}
            <div class="itf-reveal relative overflow-hidden rounded-2xl bg-itf-cream p-8 sm:p-10">
                <span aria-hidden="true" class="absolute -right-4 -top-6 text-8xl opacity-10">🎯</span>
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Notre mission</p>
                <p class="mt-4 text-lg font-semibold leading-relaxed text-itf-dark">
                    Accompagner les nouveaux bacheliers et les étudiants de Licence 1 et Licence 2
                    en Sciences de la Nature dans leur réussite universitaire, grâce à un renforcement
                    académique de qualité, accessible et personnalisé.
                </p>
            </div>

            {{-- Vision : carte sombre, pour créer le contraste --}}
            <div class="itf-reveal relative overflow-hidden rounded-2xl bg-itf-blue p-8 text-itf-white sm:p-10" style="transition-delay: 120ms">
                <span aria-hidden="true" class="absolute -right-4 -top-6 text-8xl opacity-10">🔭</span>
                <div aria-hidden="true" class="pointer-events-none absolute -bottom-16 -left-16 h-48 w-48 rounded-full bg-itf-cream/10 blur-3xl"></div>
                <p class="text-xs font-bold uppercase tracking-widest text-itf-cream">Notre vision</p>
                <p class="mt-4 text-lg font-semibold leading-relaxed">
                    Devenir la structure de référence du renforcement universitaire en Sciences de la
                    Nature en Côte d'Ivoire, en formant chaque année davantage d'étudiants confiants
                    et prêts à réussir.
                </p>
            </div>
        </div>
    </section>

    {{-- ================= Valeurs ================= --}}
    <section class="bg-itf-cream py-16 sm:py-20">
        <div class="mx-auto max-w-6xl px-4">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Ce qui nous guide</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Nos valeurs</h2>
                <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-3">
                @foreach ($valeurs as $valeur)
                    <div class="itf-reveal group rounded-2xl bg-itf-white p-7 text-center shadow transition duration-300 hover:-translate-y-1.5 hover:shadow-xl"
                         style="transition-delay: {{ ($loop->index % 3) * 100 }}ms">
                        <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-itf-cream text-3xl transition duration-300 group-hover:scale-110 group-hover:bg-itf-blue/10">
                            {{ $valeur['icone'] }}
                        </span>
                        <h3 class="mt-4 font-bold text-itf-dark transition group-hover:text-itf-blue">{{ $valeur['titre'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">{{ $valeur['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= Engagement (citation signée) ================= --}}
    <section class="mx-auto max-w-4xl px-4 py-16 sm:py-20">
        <div class="itf-reveal relative rounded-3xl border border-gray-200 bg-itf-white p-8 text-center shadow-sm sm:p-12">
            {{-- Guillemet décoratif --}}
            <span aria-hidden="true"
                  class="absolute -top-6 left-1/2 grid h-12 w-12 -translate-x-1/2 place-items-center rounded-full bg-itf-blue text-3xl font-extrabold text-itf-white shadow">
                &ldquo;
            </span>

            <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Notre engagement</p>
            <p class="mx-auto mt-5 max-w-2xl text-lg italic leading-relaxed text-gray-700">
                Depuis 11 ans, ITF accompagne les promotions d'étudiants de l'UFR Sciences
                de la Nature, avec un objectif constant : donner à chacun les moyens de réussir dès sa
                première année à l'université. Cours structurés, exercices corrigés, quiz interactifs
                et suivi individuel sont au cœur de notre démarche pédagogique.
            </p>

            <div aria-hidden="true" class="mx-auto mt-6 h-px w-16 bg-itf-blue/30"></div>
            <p class="mt-4 text-sm font-bold text-itf-dark">L'équipe Intellect Tronc SN Formation</p>
        </div>
    </section>

    {{-- ================= Appel final ================= --}}
    <section class="relative overflow-hidden bg-itf-blue py-16 text-center text-itf-white">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-20 top-0 h-64 w-64 rounded-full bg-itf-cream/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -right-16 h-72 w-72 rounded-full bg-itf-white/10 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-3xl px-4">
            <h2 class="text-3xl font-extrabold sm:text-4xl">Écrivons la suite ensemble.</h2>
            <p class="mx-auto mt-4 max-w-xl text-itf-cream/90">
                Rejoignez la prochaine promotion d'étudiants accompagnés par ITF.
                Votre premier mois est offert.
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