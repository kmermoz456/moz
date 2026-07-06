<x-admin-layout title="Paiements — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-itf-dark">Paiements</h1>
            <p class="text-sm text-itf-dark/50 mt-0.5">
                {{ $paiements->total() }} {{ Str::plural('paiement', $paiements->total()) }} enregistré{{ $paiements->total() > 1 ? 's' : '' }}
            </p>
        </div>
        <a href="{{ route('admin.paiements.create') }}"
           class="inline-flex items-center gap-2 bg-itf-blue text-itf-white font-semibold px-5 py-2.5 rounded-xl
                  shadow-sm transition-all duration-200 hover:opacity-90 hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            Enregistrer un paiement
        </a>
    </div>

    <div class="bg-itf-white rounded-2xl shadow-sm border border-itf-dark/10 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark/70 text-xs uppercase tracking-wider">
                <tr>
                    <th class="p-4 font-semibold">Étudiant</th>
                    <th class="p-4 font-semibold">Mois</th>
                    <th class="p-4 font-semibold">Montant</th>
                    <th class="p-4 font-semibold">Statut</th>
                    <th class="p-4 font-semibold">Date</th>
                    <th class="p-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-itf-dark/5">
                @forelse ($paiements as $paiement)
                    <tr class="transition-colors duration-150 hover:bg-itf-blue/5">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0 w-9 h-9 rounded-full bg-itf-blue/10 text-itf-blue font-bold
                                            flex items-center justify-center text-xs uppercase">
                                    {{ Str::substr($paiement->user->name ?? '?', 0, 1) }}{{ Str::substr($paiement->user->prenoms ?? '', 0, 1) }}
                                </div>
                                <span class="font-semibold text-itf-dark">
                                    {{ $paiement->user->name ?? '—' }} {{ $paiement->user->prenoms ?? '' }}
                                </span>
                            </div>
                        </td>
                        <td class="p-4 text-itf-dark/70">{{ $paiement->mois }}</td>
                        <td class="p-4">
                            <span class="font-semibold text-itf-dark">{{ number_format($paiement->montant, 0, ',', ' ') }}</span>
                            <span class="text-itf-dark/40 text-xs"> FCFA</span>
                        </td>
                        <td class="p-4">
                            <span @class([
                                'inline-flex items-center gap-1 text-xs px-2.5 py-1 rounded-full font-bold',
                                'bg-green-100 text-green-700' => $paiement->statut === 'valide',
                                'bg-amber-100 text-amber-700' => $paiement->statut !== 'valide',
                            ])>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    @if ($paiement->statut === 'valide')
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2"/>
                                    @endif
                                </svg>
                                {{ $paiement->statut === 'valide' ? 'Validé' : 'En attente' }}
                            </span>
                        </td>
                        <td class="p-4 text-itf-dark/50">{{ $paiement->created_at->translatedFormat('d F Y') }}</td>
                        <td class="p-4">
                            <div class="flex items-center justify-end gap-4">
                                <form method="POST" action="{{ route('admin.paiements.statut', $paiement) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="{{ $paiement->statut === 'valide' ? 'en_attente' : 'valide' }}">
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 font-semibold hover:underline transition-colors
                                                   {{ $paiement->statut === 'valide' ? 'text-amber-600 hover:text-amber-700' : 'text-green-600 hover:text-green-700' }}">
                                        @if ($paiement->statut === 'valide')
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Annuler
                                        @else
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Valider
                                        @endif
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.paiements.destroy', $paiement) }}"
                                      onsubmit="return confirm('Supprimer ce paiement ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 text-red-500/80 font-semibold hover:text-red-600 hover:underline transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-itf-dark/40">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>
                                </svg>
                                <p class="font-medium">Aucun paiement enregistré</p>
                                <p class="text-xs">Cliquez sur « Enregistrer un paiement » pour commencer.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $paiements->links() }}</div>
</x-admin-layout>