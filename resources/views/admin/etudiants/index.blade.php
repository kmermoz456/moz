<x-admin-layout title="Étudiants — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-itf-dark">Étudiants</h1>
            <p class="text-sm text-itf-dark/50 mt-0.5">
                {{ $etudiants->total() }} {{ Str::plural('étudiant', $etudiants->total()) }} inscrit{{ $etudiants->total() > 1 ? 's' : '' }}
            </p>
        </div>
    </div>

    {{-- Filtres --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <div class="relative flex-1 min-w-[220px]">
            <svg class="pointer-events-none absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-itf-dark/35"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
            </svg>
            <input type="text" name="recherche" value="{{ request('recherche') }}"
                   placeholder="Rechercher par nom, prénoms ou email"
                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white pl-10 pr-4 py-2.5 text-itf-dark
                          placeholder-itf-dark/35 shadow-sm transition-colors duration-200
                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
        </div>

        <select name="niveau"
                class="rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark shadow-sm
                       transition-colors duration-200 hover:border-itf-blue/40
                       focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
            <option value="">Tous niveaux</option>
            <option value="L1" @selected(request('niveau') === 'L1')>L1</option>
            <option value="L2" @selected(request('niveau') === 'L2')>L2</option>
        </select>

        <button type="submit"
                class="inline-flex items-center gap-2 bg-itf-blue text-itf-white font-semibold px-6 py-2.5 rounded-xl
                       shadow-sm transition-all duration-200 hover:opacity-90 hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4.5h18M6 9h12M9 13.5h6M11 18h2"/>
            </svg>
            Filtrer
        </button>

        @if (request('recherche') || request('niveau'))
            <a href="{{ route('admin.etudiants.index') }}"
               class="inline-flex items-center gap-1.5 text-sm text-itf-dark/50 hover:text-itf-blue transition-colors px-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Réinitialiser
            </a>
        @endif
    </form>

    {{-- Tableau --}}
    <div class="bg-itf-white rounded-2xl shadow-sm border border-itf-dark/10 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark/70 text-xs uppercase tracking-wider">
                <tr>
                    <th class="p-4 font-semibold">Étudiant</th>
                    <th class="p-4 font-semibold">Email</th>
                    <th class="p-4 font-semibold">WhatsApp</th>
                    <th class="p-4 font-semibold">Niveau</th>
                    <th class="p-4 font-semibold">Inscrit le</th>
                    <th class="p-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-itf-dark/5">
                @forelse ($etudiants as $etudiant)
                    <tr class="transition-colors duration-150 hover:bg-itf-blue/5">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0 w-9 h-9 rounded-full bg-itf-blue/10 text-itf-blue font-bold
                                            flex items-center justify-center text-xs uppercase">
                                    {{ Str::substr($etudiant->name, 0, 1) }}{{ Str::substr($etudiant->prenoms, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-itf-dark leading-tight">{{ $etudiant->name }}</p>
                                    <p class="text-itf-dark/50 text-xs leading-tight">{{ $etudiant->prenoms }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 text-itf-dark/70">{{ $etudiant->email }}</td>
                        <td class="p-4">
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $etudiant->telephone) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 text-itf-dark/70 hover:text-itf-blue transition-colors">
                                <svg class="w-3.5 h-3.5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.83 14.12c-.25.7-1.44 1.33-2 1.41-.51.08-1.16.11-1.87-.12-.43-.14-.98-.32-1.69-.62-2.97-1.28-4.91-4.27-5.06-4.47-.15-.2-1.21-1.61-1.21-3.07 0-1.46.77-2.18 1.04-2.48.27-.3.6-.37.8-.37.2 0 .4 0 .57.01.18.01.43-.07.67.51.25.6.85 2.07.92 2.22.08.15.13.33.03.53-.1.2-.15.32-.3.5-.15.17-.31.39-.44.52-.15.15-.3.31-.13.61.17.3.77 1.26 1.65 2.05 1.13 1.01 2.08 1.32 2.38 1.47.3.15.47.13.65-.08.17-.2.75-.87.95-1.17.2-.3.4-.25.67-.15.28.1 1.74.82 2.04.97.3.15.5.22.57.35.08.13.08.72-.17 1.42z"/>
                                </svg>
                                {{ $etudiant->telephone }}
                            </a>
                        </td>
                        <td class="p-4">
                            <span @class([
                                'inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold',
                                'bg-itf-blue/10 text-itf-blue' => $etudiant->niveau === 'L1',
                                'bg-amber-100 text-amber-700' => $etudiant->niveau === 'L2',
                            ])>
                                {{ $etudiant->niveau }}
                            </span>
                        </td>
                        <td class="p-4 text-itf-dark/50">{{ $etudiant->created_at->translatedFormat('d F Y') }}</td>
                        <td class="p-4 text-right">
                            <a href="{{ route('admin.etudiants.show', $etudiant) }}"
                               class="inline-flex items-center gap-1 text-itf-blue font-semibold hover:underline">
                                Voir
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-itf-dark/40">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                </svg>
                                <p class="font-medium">Aucun étudiant trouvé</p>
                                <p class="text-xs">Essayez d'ajuster vos critères de recherche.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $etudiants->links() }}</div>
</x-admin-layout>