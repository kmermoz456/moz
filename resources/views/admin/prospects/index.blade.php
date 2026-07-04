<x-admin-layout title="Contacts rapides — Back-office ITF">
    <h1 class="text-2xl font-bold text-itf-dark mb-6">Contacts rapides</h1>
    <p class="text-sm text-gray-500 mb-6">Leads collectés via le formulaire rapide présent en bas de chaque page du site.</p>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Téléphone</th>
                    <th class="p-3">Page d'origine</th>
                    <th class="p-3">Reçu le</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prospects as $prospect)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $prospect->nom }}</td>
                        <td class="p-3">{{ $prospect->telephone }}</td>
                        <td class="p-3 text-gray-500">{{ $prospect->page_source ?? '—' }}</td>
                        <td class="p-3 text-gray-500">{{ $prospect->created_at->translatedFormat('d F Y H:i') }}</td>
                        <td class="p-3">
                            <form method="POST" action="{{ route('admin.prospects.destroy', $prospect) }}"
                                  onsubmit="return confirm('Supprimer ce contact ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-3 text-gray-500">Aucun contact reçu pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $prospects->links() }}</div>
</x-admin-layout>
