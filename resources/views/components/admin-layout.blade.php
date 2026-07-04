<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Back-office ITF' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-50 text-itf-dark antialiased" x-data="{ sidebar: false }">

    {{-- Barre mobile --}}
    <div class="md:hidden flex items-center justify-between bg-itf-dark text-itf-white p-4">
        <a href="{{ route('admin.dashboard') }}" class="font-bold">ITF — Back-office</a>
        <button @click="sidebar = !sidebar" aria-label="Ouvrir le menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside x-show="sidebar || window.innerWidth >= 768" x-cloak
               class="w-64 bg-itf-dark text-itf-white flex-shrink-0 md:block">
            <div class="p-6 hidden md:block">
                <a href="{{ route('admin.dashboard') }}" class="font-bold text-xl">ITF — Back-office</a>
            </div>
            <nav class="px-4 pb-6 space-y-1 text-sm">
                @php
                    $links = [
                        ['route' => 'admin.dashboard', 'label' => '📊 Tableau de bord'],
                        ['route' => 'admin.etudiants.index', 'label' => '🎓 Étudiants'],
                        ['route' => 'admin.prospects.index', 'label' => '📇 Contacts rapides'],
                        ['route' => 'admin.cours.index', 'label' => '📄 Cours'],
                        ['route' => 'admin.paiements.index', 'label' => '💳 Paiements'],
                        ['route' => 'admin.quiz.index', 'label' => '⚡ Quiz'],
                        ['route' => 'admin.temoignages.index', 'label' => '💬 Témoignages'],
                        ['route' => 'admin.actualites.index', 'label' => '📰 Actualités'],
                        ['route' => 'admin.galerie.index', 'label' => '🖼️ Galerie'],
                        ['route' => 'admin.parametres.index', 'label' => '⚙️ Paramètres'],
                    ];
                @endphp
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}"
                       class="block px-4 py-2 rounded-lg {{ request()->routeIs($link['route'].'*') ? 'bg-itf-blue text-itf-white' : 'hover:bg-white/10' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a href="{{ route('accueil') }}" class="block px-4 py-2 rounded-lg hover:bg-white/10">🌐 Voir le site</a>
                <form method="POST" action="{{ route('deconnexion') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded-lg hover:bg-white/10">🚪 Déconnexion</button>
                </form>
            </nav>
        </aside>

        {{-- Contenu --}}
        <main class="flex-1 p-6 md:p-10">
            <x-flash-messages />
            {{ $slot }}
        </main>
    </div>

    @stack('scripts')
</body>
</html>
