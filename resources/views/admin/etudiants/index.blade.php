<x-admin-layout title="Étudiants — Back-office ITF">
    <h1 class="text-2xl font-bold text-itf-dark mb-6">Étudiants</h1>

    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <input type="text" name="recherche" value="{{ request('recherche') }}" placeholder="Rechercher par nom, prénoms ou email"
               class="flex-1 min-w-[200px] rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
        <select name="niveau" class="rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
            <option value="">Tous niveaux</option>
            <option value="L1" @selected(request('niveau') === 'L1')>L1</option>
            <option value="L2" @selected(request('niveau') === 'L2')>L2</option>
        </select>
        <button type="submit" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">Filtrer</button>
    </form>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Prénoms</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">WhatsApp</th>
                    <th class="p-3">Niveau</th>
                    <th class="p-3">Inscrit le</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($etudiants as $etudiant)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $etudiant->name }}</td>
                        <td class="p-3">{{ $etudiant->prenoms }}</td>
                        <td class="p-3">{{ $etudiant->email }}</td>
                        <td class="p-3">{{ $etudiant->telephone }}</td>
                        <td class="p-3">{{ $etudiant->niveau }}</td>
                        <td class="p-3 text-gray-500">{{ $etudiant->created_at->translatedFormat('d F Y') }}</td>
                        <td class="p-3">
                            <a href="{{ route('admin.etudiants.show', $etudiant) }}" class="text-itf-blue hover:underline">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="p-3 text-gray-500">Aucun étudiant trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $etudiants->links() }}</div>
</x-admin-layout>
