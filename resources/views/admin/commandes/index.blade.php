<x-admin-layout title="Commandes — Back-office ITF">
    <h1 class="text-2xl font-bold text-itf-dark mb-6">Commandes de documents physiques</h1>

    @php
        $libelles = [
            'en_attente' => ['label' => 'En attente', 'classe' => 'bg-amber-100 text-amber-700'],
            'confirmee'  => ['label' => 'Confirmée', 'classe' => 'bg-blue-100 text-blue-700'],
            'prete'      => ['label' => 'Prête', 'classe' => 'bg-purple-100 text-purple-700'],
            'livree'     => ['label' => 'Livrée', 'classe' => 'bg-green-100 text-green-700'],
            'annulee'    => ['label' => 'Annulée', 'classe' => 'bg-red-100 text-red-700'],
        ];
    @endphp

    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <select name="statut" onchange="this.form.submit()"
                class="rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
            <option value="">Tous les statuts</option>
            @foreach ($libelles as $valeur => $info)
                <option value="{{ $valeur }}" @selected(request('statut') === $valeur)>{{ $info['label'] }}</option>
            @endforeach
        </select>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Étudiant</th>
                    <th class="p-3">Document</th>
                    <th class="p-3">Qté</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($commandes as $commande)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $commande->user->name ?? '—' }} {{ $commande->user->prenoms ?? '' }}</td>
                        <td class="p-3">{{ $commande->document->titre ?? '—' }}</td>
                        <td class="p-3">{{ $commande->quantite }}</td>
                        <td class="p-3">{{ number_format($commande->total(), 0, ',', ' ') }} FCFA</td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $libelles[$commande->statut]['classe'] }}">
                                {{ $libelles[$commande->statut]['label'] }}
                            </span>
                        </td>
                        <td class="p-3 text-gray-500">{{ $commande->created_at->translatedFormat('d F Y') }}</td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.commandes.statut', $commande) }}" class="inline-flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="statut" onchange="this.form.submit()"
                                        class="text-xs rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                                    @foreach ($libelles as $valeur => $info)
                                        <option value="{{ $valeur }}" @selected($commande->statut === $valeur)>{{ $info['label'] }}</option>
                                    @endforeach
                                </select>
                            </form>
                            <form method="POST" action="{{ route('admin.commandes.destroy', $commande) }}" class="inline"
                                  onsubmit="return confirm('Supprimer cette commande ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-3 text-gray-500">Aucune commande pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $commandes->links() }}</div>
</x-admin-layout>
