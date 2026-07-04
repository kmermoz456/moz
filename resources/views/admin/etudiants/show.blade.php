<x-admin-layout title="Étudiant — Back-office ITF">
    <a href="{{ route('admin.etudiants.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour à la liste</a>

    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">{{ $etudiant->name }} {{ $etudiant->prenoms }}</h1>

    <div class="grid sm:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h2 class="font-bold text-itf-dark mb-3">Informations</h2>
            <ul class="text-sm space-y-2">
                <li><strong>Email :</strong> {{ $etudiant->email }}</li>
                <li><strong>WhatsApp :</strong> {{ $etudiant->telephone }}</li>
                <li><strong>Niveau :</strong> {{ $etudiant->niveau }}</li>
                <li><strong>Inscrit le :</strong> {{ $etudiant->created_at->translatedFormat('d F Y') }}</li>
                <li>
                    <strong>Essai :</strong>
                    @if ($etudiant->essaiActif())
                        <span class="text-green-700">actif jusqu'au {{ \Illuminate\Support\Carbon::parse($etudiant->essai_fin)->translatedFormat('d F Y') }}</span>
                    @else
                        <span class="text-amber-700">terminé</span>
                    @endif
                </li>
            </ul>

            <form method="POST" action="{{ route('admin.etudiants.prolonger-essai', $etudiant) }}" class="flex gap-2 mt-4">
                @csrf
                <input type="number" name="jours" min="1" max="365" value="30" required
                       class="w-24 rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                <button type="submit" class="bg-itf-blue text-itf-white text-sm font-semibold px-4 py-2 rounded-lg hover:opacity-90">
                    Prolonger l'essai (jours)
                </button>
            </form>

            <form method="POST" action="{{ route('admin.etudiants.destroy', $etudiant) }}"
                  onsubmit="return confirm('Supprimer définitivement cet étudiant ?');" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 text-sm font-semibold hover:underline">Supprimer cet étudiant</button>
            </form>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
            <h2 class="font-bold text-itf-dark mb-3">Paiements</h2>
            @forelse ($etudiant->paiements as $paiement)
                <div class="flex justify-between text-sm border-t border-gray-100 py-2">
                    <span>{{ $paiement->mois }}</span>
                    <span>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</span>
                    <span class="{{ $paiement->statut === 'valide' ? 'text-green-700' : 'text-amber-700' }}">{{ $paiement->statut }}</span>
                </div>
            @empty
                <p class="text-sm text-gray-500">Aucun paiement enregistré.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
        <h2 class="font-bold text-itf-dark mb-3">Historique des quiz</h2>
        @forelse ($etudiant->quizAttempts as $attempt)
            <div class="flex justify-between text-sm border-t border-gray-100 py-2">
                <span>{{ $attempt->quiz->titre ?? '—' }}</span>
                <span class="font-semibold">{{ $attempt->score }}/{{ $attempt->total }}</span>
                <span class="text-gray-500">{{ $attempt->created_at->translatedFormat('d F Y') }}</span>
            </div>
        @empty
            <p class="text-sm text-gray-500">Aucun quiz réalisé.</p>
        @endforelse
    </div>
</x-admin-layout>
