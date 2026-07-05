<x-admin-layout title="Actualités — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Actualités</h1>
        <a href="{{ route('admin.actualites.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Nouvelle actualité
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Titre</th>
                    <th class="p-3">Publiée</th>
                    <th class="p-3">Date</th>
                    @if (auth()->user()->estSuperAdmin())
                        <th class="p-3">Créé par</th>
                    @endif
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($actualites as $item)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $item->titre }}</td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-0.5 rounded-full {{ $item->publie ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $item->publie ? 'Publiée' : 'Masquée' }}
                            </span>
                        </td>
                        <td class="p-3 text-gray-500">{{ $item->created_at->translatedFormat('d F Y') }}</td>
                        @if (auth()->user()->estSuperAdmin())
                            <td class="p-3 text-gray-500">{{ $item->creePar->name ?? '—' }}</td>
                        @endif
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.actualites.edit', $item) }}" class="text-itf-blue hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.actualites.destroy', $item) }}" class="inline"
                                  onsubmit="return confirm('Supprimer cette actualité ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ auth()->user()->estSuperAdmin() ? 5 : 4 }}" class="p-3 text-gray-500">Aucune actualité pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $actualites->links() }}</div>
</x-admin-layout>
