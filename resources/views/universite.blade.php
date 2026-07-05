@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const map = L.map('map', { scrollWheelZoom: false }).setView([5.3721, -3.9866], 16); // Campus UNA (approximatif — à vérifier)

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(map);

            const lieux = [
                { nom: 'Amphithéâtres', lat: 5.3721, lng: -3.9866 },
                { nom: 'Bibliothèque universitaire', lat: 5.3726, lng: -3.9860 },
                { nom: 'Restaurant universitaire', lat: 5.3715, lng: -3.9872 },
                { nom: 'Résidences universitaires', lat: 5.3730, lng: -3.9878 },
                { nom: 'Services administratifs / Scolarité', lat: 5.3718, lng: -3.9855 },
            ];

            lieux.forEach(l => L.marker([l.lat, l.lng]).addTo(map).bindPopup(`<strong>${l.nom}</strong>`));
        });
    </script>
@endpush

<x-app-layout
    title="Découvrir l'Université Nangui Abrogoua — ITF"
    description="Filières, campus, système LMD et FAQ pour bien démarrer à l'UFR Sciences de la Nature de l'Université Nangui Abrogoua, avec l'accompagnement d'ITF.">

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
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-24 -top-24 h-80 w-80 rounded-full bg-itf-cream/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -right-16 h-96 w-96 rounded-full bg-itf-white/10 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 text-center">
            <p class="mx-auto inline-flex items-center gap-2 rounded-full border border-itf-cream/40 bg-itf-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-itf-cream backdrop-blur">
                Guide du nouveau bachelier
            </p>
            <h1 class="mt-5 text-4xl font-extrabold tracking-tight sm:text-5xl">
                Découvrir l'Université Nangui Abrogoua
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-itf-cream/90">
                Tout ce qu'il faut savoir sur l'UFR Sciences de la Nature avant votre rentrée :
                admission, parcours, débouchés et vie sur le campus.
            </p>
        </div>

        <svg aria-hidden="true" class="absolute bottom-0 left-0 block w-full text-itf-white" viewBox="0 0 1440 48" fill="currentColor" preserveAspectRatio="none">
            <path d="M0 48h1440V24C1200 6 960 0 720 9 480 18 240 36 0 30Z"/>
        </svg>
    </section>

    {{-- ================= Présentation & LMD ================= --}}
    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="grid items-start gap-10 md:grid-cols-2">
            <div class="itf-reveal">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Une université purement scientifique</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">L'UNA en bref</h2>
                <div class="mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
                <p class="mt-5 leading-relaxed text-gray-700">
                    Université thématique à caractère scientifique située à Abidjan, l'UNA se distingue
                    par ses formations et sa recherche orientées vers les sciences agronomiques,
                    environnementales et technologiques. Elle accueille chaque année de nombreux
                    nouveaux bacheliers scientifiques venus de toute la Côte d'Ivoire.
                </p>
                <p class="mt-4 leading-relaxed text-gray-700">
                    Ses valeurs : <strong>la tolérance, l'engagement, l'éthique, la responsabilité
                    civique et sociale, et l'excellence</strong>.
                </p>

                {{-- Repères historiques --}}
                <ol class="mt-8 space-y-0 border-l-2 border-itf-blue/20 pl-6">
                    @foreach ([
                        ['1995', "Création de l'Université d'Abobo-Adjamé"],
                        ['2012', "Elle devient l'Université Nangui Abrogoua, du nom d'une figure charismatique des Tchaman (Ébrié)"],
                        ['2023', "Nouveau décret d'organisation et de fonctionnement"],
                    ] as [$annee, $texte])
                        <li class="relative pb-6 last:pb-0">
                            <span aria-hidden="true" class="absolute -left-[31px] top-1 h-3 w-3 rounded-full border-2 border-itf-blue bg-itf-white"></span>
                            <p class="text-sm font-bold text-itf-blue">{{ $annee }}</p>
                            <p class="text-sm text-gray-600">{{ $texte }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>

            <div class="itf-reveal space-y-6">
                {{-- Système LMD --}}
                <div class="rounded-2xl bg-itf-cream p-8">
                    <h3 class="text-xl font-bold text-itf-dark">Le système LMD</h3>
                    <div class="mt-5 grid grid-cols-3 gap-3 text-center">
                        @foreach ([['L', 'Licence', '3 ans'], ['M', 'Master', '2 ans'], ['D', 'Doctorat', '3 ans']] as [$lettre, $nom, $duree])
                            <div class="rounded-xl bg-itf-white p-4 shadow-sm">
                                <p class="text-3xl font-extrabold text-itf-blue">{{ $lettre }}</p>
                                <p class="mt-1 text-sm font-bold text-itf-dark">{{ $nom }}</p>
                                <p class="text-xs text-gray-500">{{ $duree }}</p>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-5 text-sm leading-relaxed text-gray-700">
                        Chaque année universitaire est divisée en deux semestres, validés par
                        l'obtention de crédits à travers les <strong>UE (Unités d'Enseignement)</strong>.
                    </p>
                </div>

                {{-- Les 4 UFR --}}
                <div class="rounded-2xl border border-gray-200 bg-itf-white p-8">
                    <h3 class="text-xl font-bold text-itf-dark">Les 4 UFR de l'UNA</h3>
                    <ul class="mt-4 space-y-3">
                        @foreach ([
                            ['SN', 'Sciences de la Nature', true],
                            ['SFA', 'Sciences Fondamentales et Appliquées', false],
                            ['SGE', "Sciences et Gestion de l'Environnement", false],
                            ['STA', 'Sciences et Technologies des Aliments', false],
                        ] as [$sigle, $nom, $actif])
                            <li class="flex items-center gap-3 {{ $actif ? 'rounded-xl bg-itf-blue/5 p-2 -m-2' : '' }}">
                                <span class="grid h-10 w-14 shrink-0 place-items-center rounded-lg text-xs font-extrabold {{ $actif ? 'bg-itf-blue text-itf-white' : 'bg-itf-cream text-itf-dark' }}">
                                    {{ $sigle }}
                                </span>
                                <span class="text-sm {{ $actif ? 'font-bold text-itf-dark' : 'text-gray-600' }}">
                                    {{ $nom }}
                                    @if ($actif)
                                        <span class="ml-1 rounded-full bg-itf-blue px-2 py-0.5 text-[10px] font-bold uppercase text-itf-white">Notre spécialité</span>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= Critères d'admission UFR-SN ================= --}}
    <section class="bg-itf-cream py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Officiel — UFR-SN</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Critères d'admission en Licence 1</h2>
                <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
                <p class="mx-auto mt-4 max-w-2xl text-gray-700">
                    L'entrée dans le tronc commun Sciences de la Nature est ouverte aux bacheliers
                    des séries <strong>D</strong> et <strong>C</strong> remplissant ces conditions :
                </p>
            </div>

            <div class="itf-reveal mx-auto mt-10 max-w-3xl overflow-hidden rounded-2xl bg-itf-white shadow">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-itf-blue text-itf-white">
                            <th class="px-4 py-3 text-left font-bold">Critère</th>
                            <th class="px-4 py-3 text-center font-bold">Série D</th>
                            <th class="px-4 py-3 text-center font-bold">Série C</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ([
                            ['Âge maximum', '22 ans', '22 ans'],
                            ['Mathématiques', '≥ 11 / 20', '≥ 11 / 20'],
                            ['Physique', '≥ 11 / 20', '≥ 11 / 20'],
                            ['SVT', '≥ 12 / 20', '≥ 12 / 20'],
                            ['Anglais', '≥ 10 / 20', '≥ 10 / 20'],
                        ] as [$critere, $d, $c])
                            <tr class="transition hover:bg-itf-cream/50">
                                <td class="px-4 py-3 font-semibold text-itf-dark">{{ $critere }}</td>
                                <td class="px-4 py-3 text-center text-gray-700">{{ $d }}</td>
                                <td class="px-4 py-3 text-center text-gray-700">{{ $c }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="mx-auto mt-4 max-w-3xl text-center text-xs text-gray-500">
                Diplôme jugé équivalent : décision de la commission d'équivalence.
                Source : documentation officielle de l'UNA — critères susceptibles d'évoluer.
            </p>
        </div>
    </section>

    {{-- ================= Le parcours en Sciences de la Nature ================= --}}
    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Votre trajectoire</p>
            <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Le parcours en Sciences de la Nature</h2>
            <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
        </div>

        <div class="mt-12 space-y-4">
            {{-- Étape 1 : tronc commun --}}
            <div class="itf-reveal rounded-2xl border-2 border-itf-blue bg-itf-blue/5 p-6 text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Étape 1 — C'est ici qu'ITF vous accompagne</p>
                <p class="mt-2 text-xl font-extrabold text-itf-dark">Licence 1 &amp; Licence 2 — Tronc commun Sciences de la Nature</p>
                <p class="mx-auto mt-2 max-w-xl text-sm text-gray-600">
                    Deux années décisives de formation générale scientifique. C'est votre réussite
                    ici qui ouvre toutes les portes de la suite.
                </p>
            </div>

            <div aria-hidden="true" class="flex justify-center"><span class="text-2xl text-itf-blue">↓</span></div>

            {{-- Étape 2 : les 3 licences --}}
            <div class="grid gap-4 sm:grid-cols-3">
                @foreach ([
                    ['LPA', 'Licence Productions Animales'],
                    ['LPVE', "Licence Protection des Végétaux et de l'Environnement"],
                    ['LBP', 'Licence Botanique et Phytothérapie'],
                ] as [$sigle, $nom])
                    <div class="itf-reveal rounded-2xl border border-gray-200 bg-itf-white p-6 text-center transition hover:-translate-y-1 hover:border-itf-blue/30 hover:shadow-lg">
                        <span class="inline-block rounded-full bg-itf-cream px-3 py-1 text-xs font-extrabold text-itf-dark">{{ $sigle }}</span>
                        <p class="mt-3 font-bold leading-snug text-itf-dark">{{ $nom }}</p>
                        <p class="mt-1 text-xs text-gray-500">Licence 3</p>
                    </div>
                @endforeach
            </div>

            <p class="text-center text-xs text-gray-500">
                Après la Licence 2, des passerelles existent aussi vers les UFR SGE et STA.
            </p>

            <div aria-hidden="true" class="flex justify-center"><span class="text-2xl text-itf-blue">↓</span></div>

            {{-- Étape 3 : master et doctorat --}}
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="itf-reveal rounded-2xl bg-itf-cream p-6 text-center">
                    <p class="font-extrabold text-itf-dark">Master (2 ans)</p>
                    <p class="mt-1 text-sm text-gray-600">
                        7 masters spécialisés : aviculture, productions animales, génétique, biodiversité,
                        protection des végétaux, productions végétales, botanique et phytothérapie.
                    </p>
                </div>
                <div class="itf-reveal rounded-2xl bg-itf-dark p-6 text-center text-itf-white">
                    <p class="font-extrabold">Doctorat (3 ans)</p>
                    <p class="mt-1 text-sm text-gray-300">Thèse de recherche dans votre domaine de spécialisation.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= Filières (données du contrôleur) ================= --}}
    <section class="bg-itf-cream py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Zoom</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Les filières</h2>
                <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
            </div>
            <div class="mt-10 grid gap-6 sm:grid-cols-3">
                @foreach ($filieres as $filiere)
                    <div class="itf-reveal group rounded-2xl bg-itf-white p-6 shadow transition duration-300 hover:-translate-y-1.5 hover:shadow-xl"
                         style="transition-delay: {{ ($loop->index % 3) * 100 }}ms">
                        <span aria-hidden="true" class="block h-1 w-10 rounded-full bg-itf-blue transition-all duration-300 group-hover:w-16"></span>
                        <h3 class="mt-4 font-bold text-itf-blue">{{ $filiere['nom'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">{{ $filiere['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= Débouchés ================= --}}
    <section class="mx-auto max-w-6xl px-4 py-16">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Et après ?</p>
            <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Les débouchés</h2>
            <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2">
            <div class="itf-reveal rounded-2xl border border-gray-200 bg-itf-white p-7">
                <p class="inline-block rounded-full bg-itf-cream px-4 py-1 text-xs font-extrabold uppercase tracking-wider text-itf-dark">Niveau Licence</p>
                <ul class="mt-5 space-y-2.5 text-sm text-gray-700">
                    @foreach ([
                        'Adjoint chef de plantation',
                        'Technicien en protection des cultures et des végétaux',
                        'Technicien en productions animales',
                        'Technicien de laboratoire en phytopathologie',
                        'Assistant projet (coopératives agricoles...)',
                        'Enseignant de SVT en collèges et lycées',
                        'Auto-emploi : production animale ou végétale',
                    ] as $metier)
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5 text-itf-blue">✔</span> {{ $metier }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="itf-reveal rounded-2xl border border-gray-200 bg-itf-white p-7">
                <p class="inline-block rounded-full bg-itf-blue px-4 py-1 text-xs font-extrabold uppercase tracking-wider text-itf-white">Niveau Master</p>
                <ul class="mt-5 space-y-2.5 text-sm text-gray-700">
                    @foreach ([
                        "Cadre des services publics ou de projets de développement de l'élevage",
                        'Zootechnicien auprès des filières et groupements de producteurs',
                        "Manager d'unités de production animale industrielle",
                        'Consultant en productions animales et ressources halieutiques',
                        'Producteur de semences, gestionnaire post-récolte',
                        'Gestionnaire des entreprises et coopératives agricoles',
                        'Guide écotouristique, gestionnaire des écosystèmes',
                        'Producteur de médicaments traditionnels améliorés',
                    ] as $metier)
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5 text-itf-blue">✔</span> {{ $metier }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    {{-- ================= Cartographie du campus ================= --}}
    <section class="bg-itf-cream py-16">
        <div class="mx-auto max-w-6xl px-4">
            <div class="text-center">
                <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">Se repérer</p>
                <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Cartographie du campus</h2>
                <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
            </div>

            <div class="mb-10 mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($lieux as $lieu)
                    <div class="itf-reveal flex items-start gap-4 rounded-2xl bg-itf-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-itf-cream text-2xl">{{ $lieu['icone'] }}</span>
                        <div>
                            <h3 class="font-bold text-itf-dark">{{ $lieu['nom'] }}</h3>
                            <p class="mt-1 text-sm leading-relaxed text-gray-600">{{ $lieu['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="overflow-hidden rounded-2xl border-4 border-itf-white shadow-lg">
                <div id="map" class="h-96 w-full"></div>
            </div>
            <p class="mt-3 text-center text-xs text-gray-500">
                Cliquez sur les marqueurs pour identifier les lieux. Molette désactivée — utilisez les boutons +/− pour zoomer.
            </p>
        </div>
    </section>

    {{-- ================= FAQ ================= --}}
    <section class="mx-auto max-w-3xl px-4 py-16">
        <div class="text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-itf-blue">On répond à tout</p>
            <h2 class="mt-2 text-3xl font-extrabold text-itf-dark">Questions fréquentes</h2>
            <div class="mx-auto mt-3 h-1 w-16 rounded-full bg-itf-blue"></div>
        </div>

        <div class="mt-10 space-y-3">
            @foreach ($faq as $i => $item)
                <div x-data="{ open: false }"
                     class="itf-reveal overflow-hidden rounded-2xl border border-gray-200 bg-itf-white transition"
                     :class="open ? 'border-itf-blue/40 shadow-md' : ''">
                    <button @click="open = !open" :aria-expanded="open"
                            class="flex w-full items-center justify-between gap-4 p-5 text-left font-semibold text-itf-dark">
                        {{ $item['question'] }}
                        <span class="grid h-8 w-8 shrink-0 place-items-center rounded-full bg-itf-cream text-itf-blue transition duration-300"
                              :class="open ? 'rotate-180 bg-itf-blue text-itf-white' : ''">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </button>
                    <div x-show="open" x-cloak x-collapse class="px-5 pb-5 text-sm leading-relaxed text-gray-600">
                        {{ $item['reponse'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= Appel final ================= --}}
    <section class="bg-itf-blue py-16 text-center text-itf-white">
        <div class="mx-auto max-w-3xl px-4">
            <h2 class="text-3xl font-extrabold sm:text-4xl">L'UNA vous attend. ITF vous y prépare.</h2>
            <p class="mx-auto mt-4 max-w-xl text-itf-cream/90">
                Le tronc commun L1-L2 est l'étape la plus exigeante du parcours.
                Abordez-la avec un mois de renforcement offert.
            </p>
            <a href="{{ route('inscription') }}"
               class="mt-8 inline-block rounded-xl bg-itf-cream px-10 py-4 text-lg font-bold text-itf-dark shadow-lg shadow-black/20 transition hover:-translate-y-0.5 hover:shadow-xl">
                S'inscrire — 1 mois gratuit
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