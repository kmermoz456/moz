<x-admin-layout title="Nouveau paiement — Back-office ITF">
    <a href="{{ route('admin.paiements.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour aux paiements</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Enregistrer un paiement</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-xl">
        <form method="POST" action="{{ route('admin.paiements.store') }}">
            @csrf

            @if ($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-4 text-sm mb-4">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-5">
                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Étudiant</label>
                    <select name="user_id" required class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                        <option value="">— Sélectionner —</option>
                        @foreach ($etudiants as $etudiant)
                            <option value="{{ $etudiant->id }}" @selected(old('user_id') == $etudiant->id)>
                                {{ $etudiant->name }} {{ $etudiant->prenoms }} ({{ $etudiant->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-itf-dark mb-1">Montant (FCFA)</label>
                        <input type="number" name="montant" value="{{ old('montant') }}" min="0" required
                               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                    </div>
                    <div>
                        <label class="block font-semibold text-itf-dark mb-1">Mois</label>
                        <input type="text" name="mois" value="{{ old('mois', now()->translatedFormat('F Y')) }}" required
                               placeholder="Ex : Juillet 2026"
                               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Statut</label>
                    <select name="statut" required class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                        <option value="valide" @selected(old('statut', 'valide') === 'valide')>Validé</option>
                        <option value="en_attente" @selected(old('statut') === 'en_attente')>En attente</option>
                    </select>
                </div>

                <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
                    Enregistrer le paiement
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
