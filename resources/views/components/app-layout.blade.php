<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $titrePage = $title ?? 'ITF — Intellect Tronc SN Formation';
        $descriptionPage = $description ?? "Intellect Tronc SN Formation (ITF) accompagne les étudiants de Licence 1 et Licence 2 en Sciences de la Nature de l'Université Nangui Abrogoua : cours, quiz, exercices corrigés et suivi personnalisé. 1 mois gratuit pour les nouveaux bacheliers.";
        $imagePartage = isset($image) ? asset($image) : asset('images/banner.png');
    @endphp
    <title>{{ $titrePage }}</title>
    <meta name="description" content="{{ $descriptionPage }}">
    <link rel="canonical" href="{{ url()->current() }}">
    @if (isset($noindex) && $noindex)
        <meta name="robots" content="noindex, nofollow">
    @endif

    {{-- Open Graph / réseaux sociaux --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ITF — Intellect Tronc SN Formation">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="{{ $titrePage }}">
    <meta property="og:description" content="{{ $descriptionPage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $imagePartage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $titrePage }}">
    <meta name="twitter:description" content="{{ $descriptionPage }}">
    <meta name="twitter:image" content="{{ $imagePartage }}">

    <link rel="icon" type="image/png" href="{{ asset('images/icon_ITF.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        [x-cloak] { display: none !important; }

        /* Soulignement animé des liens du menu */
        .lien-nav {
            position: relative;
            white-space: nowrap;
        }
        .lien-nav::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            height: 2px;
            width: 100%;
            border-radius: 2px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .25s ease;
        }
        .lien-nav:hover::after,
        .lien-nav.actif::after {
            transform: scaleX(1);
        }
    </style>

    {{-- Google Analytics --}}
    @if (config('services.google_analytics.id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){ dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{{ config('services.google_analytics.id') }}');
        </script>
    @endif

    {{-- Meta Pixel --}}
    @if (config('services.facebook_pixel.id'))
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ config('services.facebook_pixel.id') }}');
            fbq('track', 'PageView');
        </script>
    @endif
</head>
<body class="bg-itf-white text-itf-dark antialiased">

    {{-- ================= Bandeau d'urgence ================= --}}
    <div x-data="{ show: !sessionStorage.getItem('itf_bandeau_ferme') }" x-show="show" x-cloak
         class="relative bg-itf-blue px-10 py-2 text-center text-sm text-itf-white">
        <span class="font-semibold">🔥 Inscriptions ouvertes</span>
        <span class="hidden sm:inline">—</span>
        <span class="block sm:inline">
            Plus que <strong>{{ $placesDisponibles ?? 15 }} places</strong> pour le mois gratuit !
            <a href="{{ route('inscription') }}" class="ml-1 font-semibold underline underline-offset-2 hover:text-itf-cream">Je m'inscris</a>
        </span>
        <button @click="show = false; sessionStorage.setItem('itf_bandeau_ferme', '1')"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-itf-white/80 transition hover:text-itf-white"
                aria-label="Fermer">&times;</button>
    </div>

    {{-- ================= En-tête ================= --}}
    <header class="sticky top-0 z-40 border-b border-gray-200 bg-itf-white/95 backdrop-blur"
            x-data="{ open: false, decouvrir: false }">
        <div class="mx-auto max-w-6xl px-4" @click.outside="open = false; decouvrir = false">
            <div class="flex h-16 items-center justify-between gap-4">

                {{-- Logo --}}
                <a href="{{ route('accueil') }}" class="flex shrink-0 items-center gap-2">
                    <img src="{{ asset('images/icon_ITF.png') }}" alt="ITF" class="h-10 w-auto">
                    <span class="hidden text-xs leading-tight text-gray-500 xl:block">
                        Renforcement<br>académique
                    </span>
                </a>

                {{-- ===== Menu desktop (à partir de lg pour éviter tout débordement) ===== --}}
                <nav class="hidden items-center gap-5 text-sm font-medium lg:flex">
                    <a href="{{ route('accueil') }}"
                       class="lien-nav hover:text-itf-blue {{ request()->routeIs('accueil') ? 'actif text-itf-blue font-semibold' : '' }}">Accueil</a>
                    <a href="{{ route('universite') }}"
                       class="lien-nav hover:text-itf-blue {{ request()->routeIs('universite') ? 'actif text-itf-blue font-semibold' : '' }}">Université</a>
                    <a href="{{ route('pourquoi') }}"
                       class="lien-nav hover:text-itf-blue {{ request()->routeIs('pourquoi') ? 'actif text-itf-blue font-semibold' : '' }}">Pourquoi ITF&nbsp;?</a>

                    {{-- Menu déroulant "Découvrir" : regroupe les pages secondaires --}}
                    <div class="relative" @keydown.escape.window="decouvrir = false">
                        <button @click="decouvrir = !decouvrir" :aria-expanded="decouvrir"
                                class="flex items-center gap-1 whitespace-nowrap transition hover:text-itf-blue
                                       {{ request()->routeIs('temoignages') || request()->routeIs('statistiques') || request()->routeIs('apropos') ? 'font-semibold text-itf-blue' : '' }}">
                            Découvrir
                            <svg class="h-4 w-4 transition duration-200" :class="decouvrir ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="decouvrir" x-cloak
                             x-transition:enter="transition duration-150"
                             x-transition:enter-start="opacity-0 -translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             @click="decouvrir = false"
                             class="absolute left-1/2 top-full mt-3 w-52 -translate-x-1/2 overflow-hidden rounded-xl border border-gray-100 bg-itf-white shadow-xl">
                            <a href="{{ route('temoignages') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition hover:bg-itf-cream {{ request()->routeIs('temoignages') ? 'font-semibold text-itf-blue' : '' }}">
                                ⭐ Témoignages
                            </a>
                            <a href="{{ route('statistiques') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition hover:bg-itf-cream {{ request()->routeIs('statistiques') ? 'font-semibold text-itf-blue' : '' }}">
                                📊 Statistiques
                            </a>
                            <a href="{{ route('apropos') }}"
                               class="flex items-center gap-3 px-4 py-3 text-sm transition hover:bg-itf-cream {{ request()->routeIs('apropos') ? 'font-semibold text-itf-blue' : '' }}">
                                🏫 À propos
                            </a>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <a href="{{ route('whatsapp') }}"
                       class="flex items-center gap-1.5 whitespace-nowrap rounded-full bg-green-500 px-3.5 py-1.5 font-semibold text-itf-white transition hover:bg-green-600">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 0 0-8.5 15.05L2 22l5.1-1.5A9.9 9.9 0 1 0 12.04 2Zm0 18.1a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.02.9.9-2.95-.2-.3a8.2 8.2 0 1 1 6.82 3.68Z"/></svg>
                        WhatsApp
                    </a>

                    <span aria-hidden="true" class="h-6 w-px bg-gray-200"></span>

                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="lien-nav hover:text-itf-blue">Back-office</a>
                        @else
                            <a href="{{ route('etudiant.dashboard') }}" class="lien-nav hover:text-itf-blue">Mon espace</a>
                            <a href="{{ route('etudiant.documents.index') }}" class="lien-nav hover:text-itf-blue">📦 Documents</a>
                        @endif
                        <form method="POST" action="{{ route('deconnexion') }}">
                            @csrf
                            <button type="submit" class="whitespace-nowrap text-gray-500 transition hover:text-itf-blue">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('connexion') }}" class="lien-nav hover:text-itf-blue">Connexion</a>
                        <a href="{{ route('inscription') }}"
                           class="whitespace-nowrap rounded-xl bg-itf-blue px-4 py-2 font-bold text-itf-white shadow-sm shadow-itf-blue/30 transition hover:-translate-y-0.5 hover:shadow-md">
                            S'inscrire
                        </a>
                    @endauth
                </nav>

                {{-- Bouton burger (mobile + tablette) --}}
                <button @click="open = !open" :aria-expanded="open"
                        class="rounded-lg p-2 text-itf-dark transition hover:bg-itf-cream lg:hidden"
                        aria-label="Ouvrir le menu">
                    <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- ===== Menu mobile ===== --}}
            <nav x-show="open" x-cloak
                 x-transition:enter="transition duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="flex flex-col gap-1 border-t border-gray-100 pb-4 pt-3 text-sm font-medium lg:hidden">

                @foreach ([
                    ['accueil',      'Accueil',        '🏠'],
                    ['universite',   'Université',     '🎓'],
                    ['pourquoi',     'Pourquoi ITF ?', '💡'],
                    ['temoignages',  'Témoignages',    '⭐'],
                    ['statistiques', 'Statistiques',   '📊'],
                    ['apropos',      'À propos',       '🏫'],
                ] as [$routeNom, $libelle, $icone])
                    <a href="{{ route($routeNom) }}"
                       class="flex items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-itf-cream
                              {{ request()->routeIs($routeNom) ? 'bg-itf-cream font-semibold text-itf-blue' : '' }}">
                        <span>{{ $icone }}</span> {{ $libelle }}
                    </a>
                @endforeach

                <a href="{{ route('whatsapp') }}"
                   class="mt-2 flex items-center justify-center gap-2 rounded-xl bg-green-500 px-4 py-3 font-semibold text-itf-white transition hover:bg-green-600">
                    <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 0 0-8.5 15.05L2 22l5.1-1.5A9.9 9.9 0 1 0 12.04 2Zm0 18.1a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.02.9.9-2.95-.2-.3a8.2 8.2 0 1 1 6.82 3.68Z"/></svg>
                    Rejoindre le groupe WhatsApp
                </a>

                <div class="mt-2 border-t border-gray-100 pt-3">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-itf-cream">⚙️ Back-office</a>
                        @else
                            <a href="{{ route('etudiant.dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-itf-cream">👤 Mon espace</a>
                            <a href="{{ route('etudiant.documents.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-itf-cream">📦 Documents</a>
                        @endif
                        <form method="POST" action="{{ route('deconnexion') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-gray-500 transition hover:bg-itf-cream hover:text-itf-dark">
                                ↩️ Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('connexion') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 transition hover:bg-itf-cream">👤 Connexion</a>
                        <a href="{{ route('inscription') }}"
                           class="mt-2 block rounded-xl bg-itf-blue px-4 py-3 text-center font-bold text-itf-white transition hover:opacity-90">
                            S'inscrire — 1 mois gratuit
                        </a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <x-flash-messages />

    <main>
        {{ $slot }}
    </main>

    {{-- ================= Formulaire rapide ================= --}}
    <section class="relative overflow-hidden bg-itf-blue py-14">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-20 top-0 h-56 w-56 rounded-full bg-itf-cream/10 blur-3xl"></div>
            <div class="absolute -bottom-24 -right-16 h-64 w-64 rounded-full bg-itf-white/10 blur-3xl"></div>
        </div>
        <div class="relative mx-auto max-w-3xl px-4 text-center">
            <h2 class="text-xl font-extrabold text-itf-white sm:text-2xl">Envie d'être rappelé ?</h2>
            <p class="mb-6 mt-2 text-sm text-itf-cream/90">Laissez vos coordonnées, notre équipe vous contacte sur WhatsApp.</p>
            <div class="mx-auto max-w-xl rounded-2xl bg-itf-white p-6 shadow-xl">
                <x-quick-form />
            </div>
        </div>
    </section>

    {{-- ================= Pied de page ================= --}}
    <footer class="bg-itf-dark text-itf-white">
        <div class="mx-auto grid max-w-6xl gap-10 px-4 py-12 sm:grid-cols-3">
            <div>
                <img src="{{ asset('images/icon_ITF.png') }}" alt="ITF" class="mb-4 h-10 w-auto">
                <p class="text-sm leading-relaxed text-gray-300">
                    Intellect Tronc SN Formation — renforcement académique pour les étudiants de
                    Licence 1 et Licence 2 en Sciences de la Nature de l'Université Nangui Abrogoua.
                </p>
            </div>
            <div>
                <h3 class="mb-3 text-xs font-bold uppercase tracking-widest text-itf-cream">Contacts</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li class="flex items-center gap-2">✉️ contact@itf.ci</li>
                    <li>
                        <a href="{{ route('whatsapp') }}" class="flex items-center gap-2 transition hover:text-itf-white">
                            💬 +225 07 00 00 00 00
                        </a>
                    </li>
                    <li class="flex items-center gap-2">📍 Abidjan, Côte d'Ivoire</li>
                </ul>
            </div>
            <div>
                <h3 class="mb-3 text-xs font-bold uppercase tracking-widest text-itf-cream">Liens</h3>
                <ul class="space-y-2 text-sm text-gray-300">
                    <li><a href="{{ route('universite') }}" class="transition hover:text-itf-white hover:underline">Découvrir l'université</a></li>
                    <li><a href="{{ route('pourquoi') }}" class="transition hover:text-itf-white hover:underline">Pourquoi choisir ITF ?</a></li>
                    <li><a href="{{ route('temoignages') }}" class="transition hover:text-itf-white hover:underline">Témoignages</a></li>
                    <li><a href="{{ route('statistiques') }}" class="transition hover:text-itf-white hover:underline">Statistiques</a></li>
                    <li><a href="{{ route('apropos') }}" class="transition hover:text-itf-white hover:underline">À propos</a></li>
                    <li><a href="{{ route('inscription') }}" class="font-semibold text-itf-cream transition hover:text-itf-white hover:underline">S'inscrire — 1 mois gratuit</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 py-4 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} ITF — Intellect Tronc SN Formation. Tous droits réservés.
        </div>
    </footer>

    {{-- ================= Bouton WhatsApp flottant ================= --}}
    <a href="{{ $whatsappLien ?? route('whatsapp') }}" target="_blank" rel="noopener"
       aria-label="Discuter sur WhatsApp"
       class="group fixed bottom-5 right-5 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-green-500 text-itf-white shadow-lg shadow-green-500/40 transition hover:scale-110 hover:bg-green-600">
        <span aria-hidden="true" class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-30 group-hover:animate-none"></span>
        <svg viewBox="0 0 24 24" class="relative h-7 w-7 fill-current" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 0 0-8.5 15.05L2 22l5.1-1.5A9.9 9.9 0 1 0 12.04 2Zm0 18.1a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.02.9.9-2.95-.2-.3a8.2 8.2 0 1 1 6.82 3.68Zm4.5-6.13c-.25-.13-1.46-.72-1.68-.8-.23-.09-.4-.13-.56.12-.17.25-.64.8-.78.97-.15.16-.29.18-.53.06-.25-.12-1.04-.38-1.98-1.22a7.4 7.4 0 0 1-1.37-1.7c-.14-.25-.02-.38.1-.5.12-.12.25-.3.37-.44.13-.15.17-.25.25-.42.08-.16.04-.31-.02-.44-.06-.12-.55-1.34-.76-1.83-.2-.48-.4-.42-.56-.43h-.48c-.16 0-.44.06-.67.31-.23.25-.87.85-.87 2.07 0 1.22.9 2.4 1.02 2.57.12.16 1.75 2.67 4.23 3.74.6.26 1.05.41 1.41.53.6.19 1.13.16 1.56.1.48-.07 1.46-.6 1.67-1.18.2-.57.2-1.06.14-1.17-.06-.1-.22-.16-.47-.28Z"/></svg>
    </a>

    {{-- ================= Pop-up d'inscription pour nouveaux visiteurs ================= --}}
    {{-- Réapparaît après 7 jours. Pour le tester : localStorage.removeItem('itf_popup_vu') dans la console. --}}
    @guest
        <div x-data="{
                open: false,
                fermer() {
                    this.open = false;
                    localStorage.setItem('itf_popup_vu', Date.now());
                },
                init() {
                    const vu = localStorage.getItem('itf_popup_vu');
                    const septJours = 7 * 24 * 60 * 60 * 1000;
                    if (!vu || Date.now() - Number(vu) > septJours) {
                        setTimeout(() => { this.open = true }, 4000);
                    }
                }
             }"
             x-show="open" x-cloak
             @keydown.escape.window="fermer()"
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4"
             role="dialog" aria-modal="true">
            <div @click.outside="fermer()"
                 x-show="open"
                 x-transition:enter="transition duration-300 ease-out"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative w-full max-w-md overflow-hidden rounded-3xl bg-itf-white shadow-2xl">

                {{-- Bandeau supérieur : logo + offre --}}
                <div class="relative overflow-hidden bg-itf-blue px-8 pb-6 pt-8 text-center text-itf-white">
                    <div aria-hidden="true" class="pointer-events-none absolute inset-0">
                        <div class="absolute -right-12 -top-12 h-44 w-44 rounded-full bg-itf-cream/15 blur-2xl"></div>
                        <div class="absolute -bottom-16 -left-10 h-36 w-36 rounded-full bg-itf-white/10 blur-2xl"></div>
                    </div>

                    <div class="relative">
                        {{-- Logo ITF --}}
                        <span class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-itf-white p-1.5 shadow-lg">
                            <img src="{{ asset('images/icon_ITF.png') }}" alt="Logo ITF" class="h-full w-full object-contain">
                        </span>

                        <h2 class="mt-4 text-xl font-extrabold leading-snug">
                            🎁 1 mois gratuit pour les<br>nouveaux bacheliers !
                        </h2>

                        {{-- Urgence --}}
                        <p class="mx-auto mt-3 inline-flex items-center gap-2 rounded-full bg-itf-white/15 px-4 py-1.5 text-xs font-bold uppercase tracking-wider backdrop-blur">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-itf-cream opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-itf-cream"></span>
                            </span>
                            Plus que {{ $placesDisponibles ?? 15 }} places ce mois-ci
                        </p>
                    </div>
                </div>

                <div class="p-7 pt-5">
                    {{-- Réassurance --}}
                    <div class="mb-5 flex flex-wrap items-center justify-center gap-x-4 gap-y-1.5 text-xs font-semibold text-gray-600">
                        <span class="inline-flex items-center gap-1"><span class="text-itf-blue">✔</span> Sans engagement</span>
                        <span class="inline-flex items-center gap-1"><span class="text-itf-blue">✔</span> Accès immédiat</span>
                        <span class="inline-flex items-center gap-1"><span class="text-itf-blue">✔</span> 30 secondes</span>
                    </div>

                    <x-quick-form :compact="true" />

                    {{-- Séparateur --}}
                    <div class="my-4 flex items-center gap-3" aria-hidden="true">
                        <span class="h-px flex-1 bg-gray-200"></span>
                        <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">ou</span>
                        <span class="h-px flex-1 bg-gray-200"></span>
                    </div>

                    <a href="{{ route('inscription') }}"
                       class="group flex items-center justify-center gap-2 rounded-xl border-2 border-itf-blue/30 px-5 py-3 text-sm font-bold text-itf-blue transition hover:border-itf-blue hover:bg-itf-blue/5">
                        Créer directement mon compte
                        <span class="transition group-hover:translate-x-1">→</span>
                    </a>

                    <p class="mt-4 text-center text-[11px] text-gray-400">
                        🔒 Vos informations restent confidentielles.
                    </p>
                </div>

                <button @click="fermer()"
                        class="absolute right-4 top-4 grid h-8 w-8 place-items-center rounded-full text-itf-white/80 transition hover:bg-itf-white/10 hover:text-itf-white"
                        aria-label="Fermer">&times;</button>
            </div>
        </div>
    @endguest

    @stack('scripts')
</body>
</html>