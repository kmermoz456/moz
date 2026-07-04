<x-admin-layout title="Cours — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Cours</h1>
        <a href="{{ route('admin.cours.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Nouveau cours
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Titre</th>
                    <th class="p-3">Matière</th>
                    <th class="p-3">Niveau</th>
                    <th class="p-3">Accès</th>
                    <th class="p-3">Téléchargements</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cours as $item)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $item->titre }}</td>
                        <td class="p-3">{{ $item->matiere }}</td>
                        <td class="p-3">{{ $item->niveau }}</td>
                        <td class="p-3">
                            @if ($item->gratuit)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Gratuit</span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-full">Payant</span>
                            @endif
                        </td>
                        <td class="p-3">{{ $item->telechargements }}</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.cours.edit', $item) }}" class="text-itf-blue hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.cours.destroy', $item) }}" class="inline"
                                  onsubmit="return confirm('Supprimer ce cours ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-3 text-gray-500">Aucun cours pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $cours->links() }}</div>
</x-admin-layout>
