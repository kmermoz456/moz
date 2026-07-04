<x-admin-layout title="Paiements — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Paiements</h1>
        <a href="{{ route('admin.paiements.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Enregistrer un paiement
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Étudiant</th>
                    <th class="p-3">Mois</th>
                    <th class="p-3">Montant</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($paiements as $paiement)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $paiement->user->name ?? '—' }} {{ $paiement->user->prenoms ?? '' }}</td>
                        <td class="p-3">{{ $paiement->mois }}</td>
                        <td class="p-3">{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $paiement->statut === 'valide' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $paiement->statut === 'valide' ? 'Validé' : 'En attente' }}
                            </span>
                        </td>
                        <td class="p-3 text-gray-500">{{ $paiement->created_at->translatedFormat('d F Y') }}</td>
                        <td class="p-3 space-x-2">
                            <form method="POST" action="{{ route('admin.paiements.statut', $paiement) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="statut" value="{{ $paiement->statut === 'valide' ? 'en_attente' : 'valide' }}">
                                <button type="submit" class="text-itf-blue hover:underline">
                                    {{ $paiement->statut === 'valide' ? 'Annuler' : 'Valider' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.paiements.destroy', $paiement) }}" class="inline"
                                  onsubmit="return confirm('Supprimer ce paiement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-3 text-gray-500">Aucun paiement enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $paiements->links() }}</div>
</x-admin-layout>
