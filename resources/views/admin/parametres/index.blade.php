<x-admin-layout title="Paramètres — Back-office ITF">
    <h1 class="text-2xl font-bold text-itf-dark mb-6">Paramètres — Chiffres clés de l'accueil</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-xl">
        <form method="POST" action="{{ route('admin.parametres.update') }}">
            @csrf
            @method('PUT')

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
                    <label class="block font-semibold text-itf-dark mb-1">Taux de réussite (%)</label>
                    <input type="number" name="taux_reussite" min="0" max="100"
                           value="{{ old('taux_reussite', $parametres['taux_reussite']) }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Nombre d'enseignants</label>
                    <input type="number" name="nombre_enseignants" min="0"
                           value="{{ old('nombre_enseignants', $parametres['nombre_enseignants']) }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Taux de satisfaction (%)</label>
                    <input type="number" name="taux_satisfaction" min="0" max="100"
                           value="{{ old('taux_satisfaction', $parametres['taux_satisfaction']) }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Années d'expérience</label>
                    <input type="number" name="annees_experience" min="0"
                           value="{{ old('annees_experience', $parametres['annees_experience']) }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Lien du groupe WhatsApp</label>
                    <input type="url" name="whatsapp_lien" placeholder="https://chat.whatsapp.com/..."
                           value="{{ old('whatsapp_lien', $parametres['whatsapp_lien']) }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Places disponibles ce mois-ci</label>
                    <input type="number" name="places_disponibles" min="0"
                           value="{{ old('places_disponibles', $parametres['places_disponibles']) }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                    <p class="text-xs text-gray-500 mt-1">Affiché dans le bandeau d'urgence sur tout le site.</p>
                </div>

                <p class="text-xs text-gray-500">Le nombre d'étudiants formés est calculé automatiquement et n'est pas modifiable ici.</p>

                <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
