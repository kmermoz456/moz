<x-admin-layout title="Tableau de bord — Back-office ITF">

    {{-- En-tête --}}
    <div class="flex flex-col gap-1 mb-8 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-itf-blue/80">Intellect Tronc SN Formation</p>
            <h1 class="text-2xl sm:text-3xl font-bold text-itf-dark tracking-tight">Tableau de bord</h1>
        </div>
        <p class="text-sm text-gray-500 capitalize">{{ now()->translatedFormat('l d F Y') }}</p>
    </div>

    {{-- Cartes statistiques --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-12">

        {{-- Carte mise en avant : recettes du mois --}}
        <div class="relative overflow-hidden rounded-2xl p-5 bg-gradient-to-br from-itf-blue to-indigo-600 text-white shadow-lg shadow-itf-blue/20">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-white/10"></div>
            <div class="relative">
                <div class="flex items-center justify-center h-10 w-10 rounded-xl bg-white/15 mb-4">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                </div>
                <p class="text-sm text-white/80">Recettes du mois</p>
                <p class="text-2xl font-bold mt-1">{{ number_format($stats['recettes_mois'], 0, ',', ' ') }}<span class="text-base font-semibold text-white/80"> FCFA</span></p>
            </div>
        </div>

        {{-- Autres indicateurs --}}
        @php
            $cards = [
                ['label' => 'Étudiants inscrits',       'value' => $stats['etudiants_total'],   'icon' => 'users',      'bg' => 'bg-blue-50',    'fg' => 'text-blue-600'],
                ['label' => 'Nouveaux (7 derniers jours)','value' => $stats['nouveaux_semaine'], 'icon' => 'sparkles',   'bg' => 'bg-emerald-50', 'fg' => 'text-emerald-600'],
                ['label' => "Paiements aujourd'hui",     'value' => $stats['paiements_jour'],    'icon' => 'wallet',     'bg' => 'bg-amber-50',   'fg' => 'text-amber-600'],
                ['label' => 'Paiements ce mois',         'value' => $stats['paiements_mois'],    'icon' => 'calendar',   'bg' => 'bg-violet-50',  'fg' => 'text-violet-600'],
                ['label' => 'Quiz réalisés',             'value' => $stats['quiz_realises'],     'icon' => 'quiz',       'bg' => 'bg-sky-50',     'fg' => 'text-sky-600'],
                ['label' => 'Taux de réussite moyen',    'value' => $stats['taux_reussite'].'%', 'icon' => 'chart',      'bg' => 'bg-rose-50',    'fg' => 'text-rose-600'],
                ['label' => 'Téléchargements PDF',       'value' => $stats['telechargements'],   'icon' => 'download',   'bg' => 'bg-slate-100',  'fg' => 'text-slate-600'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="group rounded-2xl p-5 bg-white border border-gray-100 shadow-sm transition hover:shadow-md hover:-translate-y-0.5">
                <div class="flex items-center justify-center h-10 w-10 rounded-xl {{ $card['bg'] }} {{ $card['fg'] }} mb-4">
                    @switch($card['icon'])
                        @case('users')
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                            @break
                        @case('sparkles')
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" /></svg>
                            @break
                        @case('wallet')
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" /></svg>
                            @break
                        @case('calendar')
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                            @break
                        @case('quiz')
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                            @break
                        @case('chart')
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                            @break
                        @case('download')
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                            @break
                    @endswitch
                </div>
                <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                <p class="text-2xl font-bold text-itf-dark mt-1">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Derniers inscrits --}}
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold text-itf-dark">Derniers étudiants inscrits</h2>
        <a href="#" class="text-sm font-medium text-itf-blue hover:underline">Voir tout</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-itf-cream/70 text-itf-dark">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Étudiant</th>
                        <th class="px-4 py-3 font-semibold">Email</th>
                        <th class="px-4 py-3 font-semibold">WhatsApp</th>
                        <th class="px-4 py-3 font-semibold">Niveau</th>
                        <th class="px-4 py-3 font-semibold text-right">Inscrit le</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($derniers_inscrits as $etudiant)
                        @php
                            $badge = match($etudiant->niveau) {
                                'L1'    => 'bg-blue-50 text-blue-700',
                                'L2'    => 'bg-violet-50 text-violet-700',
                                default => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <tr class="hover:bg-gray-50/70 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center h-9 w-9 rounded-full bg-gradient-to-br from-itf-blue to-indigo-500 text-white text-xs font-bold shrink-0">
                                        {{ strtoupper(mb_substr($etudiant->prenoms ?? $etudiant->name, 0, 1)) }}{{ strtoupper(mb_substr($etudiant->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-medium text-itf-dark truncate">{{ $etudiant->prenoms }} {{ $etudiant->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $etudiant->email }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $etudiant->telephone }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $badge }}">
                                    {{ $etudiant->niveau }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500 text-right whitespace-nowrap">{{ $etudiant->created_at->translatedFormat('d F Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <p class="text-gray-500">Aucun étudiant pour le moment.</p>
                                <p class="text-sm text-gray-400 mt-1">Les nouvelles inscriptions apparaîtront ici.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-admin-layout>