<x-admin-layout title="Documents physiques — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Catalogue de documents physiques</h1>
        <a href="{{ route('admin.documents.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Ajouter un document
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Titre</th>
                    <th class="p-3">Catégorie</th>
                    <th class="p-3">Niveau</th>
                    <th class="p-3">Prix</th>
                    <th class="p-3">Commandes</th>
                    <th class="p-3">Statut</th>
                    @if (auth()->user()->estSuperAdmin())
                        <th class="p-3">Créé par</th>
                    @endif
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $document)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $document->titre }}</td>
                        <td class="p-3">{{ $document->categorie }}</td>
                        <td class="p-3">{{ $document->niveau }}</td>
                        <td class="p-3">{{ number_format($document->prix, 0, ',', ' ') }} FCFA</td>
                        <td class="p-3">{{ $document->commandes_count }}</td>
                        <td class="p-3">
                            @if ($document->disponible)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Disponible</span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full">Masqué</span>
                            @endif
                        </td>
                        @if (auth()->user()->estSuperAdmin())
                            <td class="p-3 text-gray-500">{{ $document->creePar->name ?? '—' }}</td>
                        @endif
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.documents.edit', $document) }}" class="text-itf-blue hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.documents.destroy', $document) }}" class="inline"
                                  onsubmit="return confirm('Supprimer ce document du catalogue ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ auth()->user()->estSuperAdmin() ? 8 : 7 }}" class="p-3 text-gray-500">Aucun document dans le catalogue.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $documents->links() }}</div>
</x-admin-layout>
