<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ITF — Intellect Tronc SN Formation' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

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

    {{-- Bandeau d'urgence --}}
    <div x-data="{ show: !sessionStorage.getItem('itf_bandeau_ferme') }" x-show="show" x-cloak
         class="bg-itf-blue text-itf-white text-sm text-center py-2 px-4 relative">
        <span class="font-semibold">🔥 Inscriptions ouvertes</span>
        — Plus que <strong>{{ $placesDisponibles ?? 15 }} places</strong> disponibles ce mois-ci pour le mois gratuit !
        <a href="{{ route('inscription') }}" class="underline font-semibold ml-1">Je m'inscris</a>
        <button @click="show = false; sessionStorage.setItem('itf_bandeau_ferme', '1')"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-itf-white/80 hover:text-itf-white"
                aria-label="Fermer">&times;</button>
    </div>

    <header class="bg-itf-white border-b border-gray-200 sticky top-0 z-40" x-data="{ open: false }">
        <div class="max-w-6xl mx-auto px-4" @click.outside="open = false">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('accueil') }}" class="font-bold text-xl text-itf-blue">
                    ITF <span class="text-itf-dark font-normal text-sm hidden sm:inline">Renforcement académique</span>
                </a>

                {{-- Menu desktop --}}
                <nav class="hidden md:flex items-center gap-5 text-sm font-medium">
                    <a href="{{ route('accueil') }}" class="hover:text-itf-blue">Accueil</a>
                    <a href="{{ route('universite') }}" class="hover:text-itf-blue">Université</a>
                    <a href="{{ route('pourquoi') }}" class="hover:text-itf-blue">Pourquoi ITF ?</a>
                    <a href="{{ route('temoignages') }}" class="hover:text-itf-blue">Témoignages</a>
                    <a href="{{ route('statistiques') }}" class="hover:text-itf-blue">Statistiques</a>
                    <a href="{{ route('apropos') }}" class="hover:text-itf-blue">À propos</a>
                    <a href="{{ route('whatsapp') }}"
                       class="flex items-center gap-1 bg-green-500 text-itf-white px-3 py-1.5 rounded-lg hover:opacity-90 transition">
                        💬 WhatsApp
                    </a>

                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-itf-blue">Back-office</a>
                        @else
                            <a href="{{ route('etudiant.dashboard') }}" class="hover:text-itf-blue">Mon espace</a>
                        @endif
                        <form method="POST" action="{{ route('deconnexion') }}">
                            @csrf
                            <button type="submit" class="text-itf-dark hover:text-itf-blue">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('connexion') }}" class="hover:text-itf-blue">Connexion</a>
                        <a href="{{ route('inscription') }}"
                           class="bg-itf-blue text-itf-white px-4 py-2 rounded-lg hover:opacity-90 transition">
                            S'inscrire — 1 mois gratuit
                        </a>
                    @endauth
                </nav>

                {{-- Bouton burger mobile --}}
                <button @click="open = !open" class="md:hidden p-2 text-itf-dark" aria-label="Ouvrir le menu">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Menu mobile --}}
            <nav x-show="open" x-cloak
                 class="md:hidden pb-4 flex flex-col gap-3 text-sm font-medium" style="display: none;">
                <a href="{{ route('accueil') }}" class="hover:text-itf-blue">Accueil</a>
                <a href="{{ route('universite') }}" class="hover:text-itf-blue">Université</a>
                <a href="{{ route('pourquoi') }}" class="hover:text-itf-blue">Pourquoi ITF ?</a>
                <a href="{{ route('temoignages') }}" class="hover:text-itf-blue">Témoignages</a>
                <a href="{{ route('statistiques') }}" class="hover:text-itf-blue">Statistiques</a>
                <a href="{{ route('apropos') }}" class="hover:text-itf-blue">À propos</a>
                <a href="{{ route('whatsapp') }}"
                   class="flex items-center gap-1 bg-green-500 text-itf-white px-4 py-2 rounded-lg text-center hover:opacity-90 transition">
                    💬 Rejoindre le groupe WhatsApp
                </a>

                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-itf-blue">Back-office</a>
                    @else
                        <a href="{{ route('etudiant.dashboard') }}" class="hover:text-itf-blue">Mon espace</a>
                    @endif
                    <form method="POST" action="{{ route('deconnexion') }}">
                        @csrf
                        <button type="submit" class="text-left text-itf-dark hover:text-itf-blue">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('connexion') }}" class="hover:text-itf-blue">Connexion</a>
                    <a href="{{ route('inscription') }}"
                       class="bg-itf-blue text-itf-white px-4 py-2 rounded-lg text-center hover:opacity-90 transition">
                        S'inscrire — 1 mois gratuit
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <x-flash-messages />

    <main>
        {{ $slot }}
    </main>

    {{-- Formulaire rapide --}}
    <section class="bg-itf-blue py-12">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-xl sm:text-2xl font-bold text-itf-white mb-2">Envie d'être rappelé ?</h2>
            <p class="text-itf-cream text-sm mb-6">Laissez vos coordonnées, notre équipe vous contacte sur WhatsApp.</p>
            <div class="bg-itf-white rounded-2xl p-6 max-w-xl mx-auto">
                <x-quick-form />
            </div>
        </div>
    </section>

    <footer class="bg-itf-dark text-itf-white mt-16">
        <div class="max-w-6xl mx-auto px-4 py-10 grid gap-8 sm:grid-cols-3">
            <div>
                <h3 class="font-bold text-lg mb-2">ITF</h3>
                <p class="text-sm text-gray-300">Intellect Tronc SN Formation — renforcement académique pour les
                    étudiants de Licence 1 et Licence 2 en Sciences de la Nature de l'Université Nangui Abrogoua.</p>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">Contacts</h3>
                <ul class="text-sm text-gray-300 space-y-1">
                    <li>Email : contact@itf.ci</li>
                    <li><a href="{{ route('whatsapp') }}" class="hover:text-itf-white">WhatsApp : +225 07 00 00 00 00</a></li>
                    <li>Localisation : Abidjan, Côte d'Ivoire</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">Liens</h3>
                <ul class="text-sm text-gray-300 space-y-1">
                    <li><a href="{{ route('universite') }}" class="hover:text-itf-white">Découvrir l'université</a></li>
                    <li><a href="{{ route('pourquoi') }}" class="hover:text-itf-white">Pourquoi choisir ITF ?</a></li>
                    <li><a href="{{ route('temoignages') }}" class="hover:text-itf-white">Témoignages</a></li>
                    <li><a href="{{ route('statistiques') }}" class="hover:text-itf-white">Statistiques</a></li>
                    <li><a href="{{ route('apropos') }}" class="hover:text-itf-white">À propos</a></li>
                    <li><a href="{{ route('inscription') }}" class="hover:text-itf-white">S'inscrire</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 text-center text-xs text-gray-400 py-4">
            &copy; {{ date('Y') }} ITF — Intellect Tronc SN Formation. Tous droits réservés.
        </div>
    </footer>

    {{-- Bouton WhatsApp flottant --}}
    <a href="{{ $whatsappLien ?? route('whatsapp') }}" target="_blank" rel="noopener"
       aria-label="Discuter sur WhatsApp"
       class="fixed bottom-5 right-5 z-50 bg-green-500 text-itf-white w-14 h-14 rounded-full shadow-lg flex items-center justify-center text-2xl hover:opacity-90 transition">
        💬
    </a>

    {{-- Pop-up d'inscription pour nouveaux visiteurs --}}
    @guest
        <div x-data="{
                open: false,
                init() {
                    if (!localStorage.getItem('itf_popup_vu')) {
                        setTimeout(() => { this.open = true; localStorage.setItem('itf_popup_vu', '1') }, 4000)
                    }
                }
             }"
             x-show="open" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
            <div @click.outside="open = false" class="bg-itf-white rounded-2xl max-w-md w-full p-8 relative">
                <button @click="open = false" class="absolute top-4 right-4 text-gray-400 hover:text-itf-dark text-xl" aria-label="Fermer">&times;</button>

                <span class="text-4xl">🎁</span>
                <h2 class="text-xl font-bold text-itf-dark mt-3">1 mois gratuit pour les nouveaux bacheliers !</h2>
                <p class="text-sm text-gray-600 mt-2 mb-5">
                    Laissez vos coordonnées et rejoignez la communauté ITF dès aujourd'hui.
                </p>

                <x-quick-form :compact="true" />

                <a href="{{ route('inscription') }}" class="block text-center mt-4 text-itf-blue font-semibold hover:underline">
                    Ou créer directement mon compte →
                </a>
            </div>
        </div>
    @endguest

    @stack('scripts')
</body>
</html>
