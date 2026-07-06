<x-admin-layout title="Commandes — Back-office ITF">
    @php
        $libelles = [
            'en_attente' => ['label' => 'En attente', 'classe' => 'bg-amber-100 text-amber-700', 'dot' => 'bg-amber-500'],
            'confirmee'  => ['label' => 'Confirmée', 'classe' => 'bg-blue-100 text-blue-700', 'dot' => 'bg-blue-500'],
            'prete'      => ['label' => 'Prête', 'classe' => 'bg-purple-100 text-purple-700', 'dot' => 'bg-purple-500'],
            'livree'     => ['label' => 'Livrée', 'classe' => 'bg-green-100 text-green-700', 'dot' => 'bg-green-500'],
            'annulee'    => ['label' => 'Annulée', 'classe' => 'bg-red-100 text-red-700', 'dot' => 'bg-red-500'],
        ];
    @endphp

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-itf-dark">Commandes de documents physiques</h1>
            <p class="text-sm text-itf-dark/50 mt-0.5">
                {{ $commandes->total() }} {{ Str::plural('commande', $commandes->total()) }}{{ request('statut') ? ' · filtré par « '.$libelles[request('statut')]['label'].' »' : '' }}
            </p>
        </div>
    </div>

    {{-- Filtres en pastilles --}}
    <div class="flex flex-wrap gap-2 mb-6">
        <a href="{{ route('admin.commandes.index') }}"
           @class([
               'inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200',
               'bg-itf-dark text-itf-white' => !request('statut'),
               'bg-itf-dark/5 text-itf-dark/60 hover:bg-itf-dark/10' => request('statut'),
           ])>
            Tous les statuts
        </a>
        @foreach ($libelles as $valeur => $info)
            <a href="{{ route('admin.commandes.index', ['statut' => $valeur]) }}"
               @class([
                   'inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold transition-all duration-200',
                   $info['classe'] => request('statut') === $valeur,
                   'bg-itf-dark/5 text-itf-dark/60 hover:bg-itf-dark/10' => request('statut') !== $valeur,
               ])>
                <span class="w-1.5 h-1.5 rounded-full {{ $info['dot'] }}"></span>
                {{ $info['label'] }}
            </a>
        @endforeach
    </div>

    <div class="bg-itf-white rounded-2xl shadow-sm border border-itf-dark/10 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark/70 text-xs uppercase tracking-wider">
                <tr>
                    <th class="p-4 font-semibold">Étudiant</th>
                    <th class="p-4 font-semibold">Document</th>
                    <th class="p-4 font-semibold text-center">Qté</th>
                    <th class="p-4 font-semibold">Total</th>
                    <th class="p-4 font-semibold">Statut</th>
                    <th class="p-4 font-semibold">Date</th>
                    <th class="p-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-itf-dark/5">
                @forelse ($commandes as $commande)
                    <tr class="transition-colors duration-150 hover:bg-itf-blue/5">
                        <td class="p-4">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0 w-9 h-9 rounded-full bg-itf-blue/10 text-itf-blue font-bold
                                            flex items-center justify-center text-xs uppercase">
                                    {{ Str::substr($commande->user->name ?? '?', 0, 1) }}{{ Str::substr($commande->user->prenoms ?? '', 0, 1) }}
                                </div>
                                <span class="font-semibold text-itf-dark">
                                    {{ $commande->user->name ?? '—' }} {{ $commande->user->prenoms ?? '' }}
                                </span>
                            </div>
                        </td>
                        <td class="p-4 text-itf-dark/70">{{ $commande->document->titre ?? '—' }}</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center justify-center min-w-[1.75rem] px-2 py-0.5 rounded-full bg-itf-dark/5 text-itf-dark/70 text-xs font-bold">
                                {{ $commande->quantite }}
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="font-semibold text-itf-dark">{{ number_format($commande->total(), 0, ',', ' ') }}</span>
                            <span class="text-itf-dark/40 text-xs"> FCFA</span>
                        </td>
                        <td class="p-4">
                            <span class="inline-flex items-center gap-1.5 text-xs px-2.5 py-1 rounded-full font-bold {{ $libelles[$commande->statut]['classe'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $libelles[$commande->statut]['dot'] }}"></span>
                                {{ $libelles[$commande->statut]['label'] }}
                            </span>
                        </td>
                        <td class="p-4 text-itf-dark/50">{{ $commande->created_at->translatedFormat('d F Y') }}</td>
                        <td class="p-4">
                            <div class="flex items-center justify-end gap-3">
                                <form method="POST" action="{{ route('admin.commandes.statut', $commande) }}">
                                    @csrf
                                    @method('PATCH')
                                    <select name="statut" onchange="this.form.submit()"
                                            class="text-xs rounded-lg border border-itf-dark/15 bg-itf-white px-2.5 py-1.5
                                                   text-itf-dark shadow-sm transition-colors duration-200
                                                   hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                                        @foreach ($libelles as $valeur => $info)
                                            <option value="{{ $valeur }}" @selected($commande->statut === $valeur)>{{ $info['label'] }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <form method="POST" action="{{ route('admin.commandes.destroy', $commande) }}"
                                      onsubmit="return confirm('Supprimer cette commande ?');">
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
                        <td colspan="7" class="p-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-itf-dark/40">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                                </svg>
                                <p class="font-medium">Aucune commande {{ request('statut') ? 'avec ce statut' : 'pour le moment' }}</p>
                                <p class="text-xs">{{ request('statut') ? 'Essayez un autre filtre.' : 'Les commandes des étudiants apparaîtront ici.' }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $commandes->links() }}</div>
</x-admin-layout>