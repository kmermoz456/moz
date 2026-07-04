<x-admin-layout title="Tableau de bord — Back-office ITF">
    <h1 class="text-2xl font-bold text-itf-dark mb-6">Tableau de bord</h1>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Étudiants inscrits</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ $stats['etudiants_total'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Nouveaux (7 derniers jours)</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ $stats['nouveaux_semaine'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Paiements aujourd'hui</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ $stats['paiements_jour'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Paiements ce mois</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ $stats['paiements_mois'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Recettes du mois</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ number_format($stats['recettes_mois'], 0, ',', ' ') }} FCFA</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Quiz réalisés</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ $stats['quiz_realises'] }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Taux de réussite moyen</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ $stats['taux_reussite'] }}%</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Téléchargements PDF</p>
            <p class="text-3xl font-bold text-itf-blue mt-1">{{ $stats['telechargements'] }}</p>
        </div>
    </div>

    <h2 class="text-xl font-bold text-itf-dark mb-4">Derniers étudiants inscrits</h2>
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
                </tr>
            </thead>
            <tbody>
                @forelse ($derniers_inscrits as $etudiant)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $etudiant->name }}</td>
                        <td class="p-3">{{ $etudiant->prenoms }}</td>
                        <td class="p-3">{{ $etudiant->email }}</td>
                        <td class="p-3">{{ $etudiant->telephone }}</td>
                        <td class="p-3">{{ $etudiant->niveau }}</td>
                        <td class="p-3 text-gray-500">{{ $etudiant->created_at->translatedFormat('d F Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-3 text-gray-500">Aucun étudiant pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
