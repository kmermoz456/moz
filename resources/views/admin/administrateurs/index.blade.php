<x-admin-layout title="Administrateurs — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Administrateurs</h1>
        <a href="{{ route('admin.administrateurs.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Nouvel administrateur
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Prénoms</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Téléphone</th>
                    <th class="p-3">Créé le</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($administrateurs as $administrateur)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $administrateur->name }}</td>
                        <td class="p-3">{{ $administrateur->prenoms }}</td>
                        <td class="p-3">{{ $administrateur->email }}</td>
                        <td class="p-3">{{ $administrateur->telephone }}</td>
                        <td class="p-3 text-gray-500">{{ $administrateur->created_at->translatedFormat('d F Y') }}</td>
                        <td class="p-3">
                            @if ($administrateur->id === auth()->id())
                                <span class="text-xs bg-itf-cream text-itf-dark px-2 py-0.5 rounded-full">Vous</span>
                            @else
                                <form method="POST" action="{{ route('admin.administrateurs.destroy', $administrateur) }}"
                                      onsubmit="return confirm('Supprimer ce compte administrateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-3 text-gray-500">Aucun administrateur trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
