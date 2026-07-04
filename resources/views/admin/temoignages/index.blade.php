<x-admin-layout title="Témoignages — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Témoignages</h1>
        <a href="{{ route('admin.temoignages.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Nouveau témoignage
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Promotion</th>
                    <th class="p-3">Publié</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($temoignages as $item)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $item->nom }}</td>
                        <td class="p-3">{{ $item->promotion }}</td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $item->publie ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $item->publie ? 'Publié' : 'Masqué' }}
                            </span>
                        </td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.temoignages.edit', $item) }}" class="text-itf-blue hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.temoignages.destroy', $item) }}" class="inline"
                                  onsubmit="return confirm('Supprimer ce témoignage ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-3 text-gray-500">Aucun témoignage pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $temoignages->links() }}</div>
</x-admin-layout>
