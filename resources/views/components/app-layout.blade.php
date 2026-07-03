<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'ITF — Intellect Tronc SN Formation' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-itf-white text-itf-dark antialiased">

    <header class="bg-itf-white border-b border-gray-200 sticky top-0 z-40" x-data="{ open: false }">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('accueil') }}" class="font-bold text-xl text-itf-blue">
                    ITF <span class="text-itf-dark font-normal text-sm hidden sm:inline">Renforcement académique</span>
                </a>

                {{-- Menu desktop --}}
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                    <a href="{{ route('accueil') }}" class="hover:text-itf-blue">Accueil</a>
                    <a href="{{ route('universite') }}" class="hover:text-itf-blue">Université</a>
                    <a href="{{ route('pourquoi') }}" class="hover:text-itf-blue">Pourquoi ITF ?</a>

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
            <nav x-show="open" x-cloak @click.outside="open = false"
                 class="md:hidden pb-4 flex flex-col gap-3 text-sm font-medium" style="display: none;">
                <a href="{{ route('accueil') }}" class="hover:text-itf-blue">Accueil</a>
                <a href="{{ route('universite') }}" class="hover:text-itf-blue">Université</a>
                <a href="{{ route('pourquoi') }}" class="hover:text-itf-blue">Pourquoi ITF ?</a>

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
                    <li>WhatsApp : +225 07 00 00 00 00</li>
                    <li>Localisation : Abidjan, Côte d'Ivoire</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2">Liens</h3>
                <ul class="text-sm text-gray-300 space-y-1">
                    <li><a href="{{ route('universite') }}" class="hover:text-itf-white">Découvrir l'université</a></li>
                    <li><a href="{{ route('pourquoi') }}" class="hover:text-itf-white">Pourquoi choisir ITF ?</a></li>
                    <li><a href="{{ route('inscription') }}" class="hover:text-itf-white">S'inscrire</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 text-center text-xs text-gray-400 py-4">
            &copy; {{ date('Y') }} ITF — Intellect Tronc SN Formation. Tous droits réservés.
        </div>
    </footer>
</body>
</html>
