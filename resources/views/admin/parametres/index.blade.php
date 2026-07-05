<x-admin-layout title="Paramètres — Back-office ITF">

    {{-- En-tête de page --}}
    <div class="mb-8">
        <h1 class="text-2xl font-extrabold text-itf-dark">Paramètres du site</h1>
        <p class="mt-1 text-sm text-gray-500">
            Les valeurs modifiées ici sont immédiatement visibles sur le site public.
        </p>
    </div>

    <form method="POST" action="{{ route('admin.parametres.update') }}" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')

        {{-- Erreurs de validation --}}
        @if ($errors->any())
            <div class="flex gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
                <span aria-hidden="true" class="text-lg leading-none">⚠️</span>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ===== Section : chiffres clés ===== --}}
        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-itf-blue/10 text-xl">📊</span>
                <div>
                    <h2 class="font-bold text-itf-dark">Chiffres clés de l'accueil</h2>
                    <p class="text-xs text-gray-500">Affichés dans la section « compteurs animés » de la page d'accueil</p>
                </div>
            </div>

            <div class="grid gap-5 p-6 sm:grid-cols-2">
                {{-- Taux de réussite --}}
                <div>
                    <label for="taux_reussite" class="mb-1.5 block text-sm font-bold text-itf-dark">Taux de réussite</label>
                    <div class="relative">
                        <input type="number" id="taux_reussite" name="taux_reussite" min="0" max="100"
                               value="{{ old('taux_reussite', $parametres['taux_reussite']) }}" required
                               class="w-full rounded-xl border border-gray-300 py-3 pl-4 pr-12 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                        <span aria-hidden="true" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">%</span>
                    </div>
                </div>

                {{-- Taux de satisfaction --}}
                <div>
                    <label for="taux_satisfaction" class="mb-1.5 block text-sm font-bold text-itf-dark">Taux de satisfaction</label>
                    <div class="relative">
                        <input type="number" id="taux_satisfaction" name="taux_satisfaction" min="0" max="100"
                               value="{{ old('taux_satisfaction', $parametres['taux_satisfaction']) }}" required
                               class="w-full rounded-xl border border-gray-300 py-3 pl-4 pr-12 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                        <span aria-hidden="true" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">%</span>
                    </div>
                </div>

                {{-- Nombre d'enseignants --}}
                <div>
                    <label for="nombre_enseignants" class="mb-1.5 block text-sm font-bold text-itf-dark">Nombre d'enseignants</label>
                    <input type="number" id="nombre_enseignants" name="nombre_enseignants" min="0"
                           value="{{ old('nombre_enseignants', $parametres['nombre_enseignants']) }}" required
                           class="w-full rounded-xl border border-gray-300 px-4 py-3 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                </div>

                {{-- Années d'expérience --}}
                <div>
                    <label for="annees_experience" class="mb-1.5 block text-sm font-bold text-itf-dark">Années d'expérience</label>
                    <div class="relative">
                        <input type="number" id="annees_experience" name="annees_experience" min="0"
                               value="{{ old('annees_experience', $parametres['annees_experience']) }}" required
                               class="w-full rounded-xl border border-gray-300 py-3 pl-4 pr-14 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                        <span aria-hidden="true" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">ans</span>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-100 bg-gray-50/50 px-6 py-3">
                <p class="flex items-center gap-2 text-xs text-gray-500">
                    <span aria-hidden="true">ℹ️</span>
                    Le nombre d'étudiants formés est calculé automatiquement et n'est pas modifiable ici.
                </p>
            </div>
        </div>

        {{-- ===== Section : marketing ===== --}}
        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="flex items-center gap-3 border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                <span class="grid h-10 w-10 place-items-center rounded-xl bg-green-500/10 text-xl">📣</span>
                <div>
                    <h2 class="font-bold text-itf-dark">Marketing &amp; communauté</h2>
                    <p class="text-xs text-gray-500">Bandeau d'urgence, pop-up et boutons WhatsApp du site</p>
                </div>
            </div>

            <div class="space-y-5 p-6">
                {{-- Lien WhatsApp --}}
                <div>
                    <label for="whatsapp_lien" class="mb-1.5 block text-sm font-bold text-itf-dark">Lien du groupe WhatsApp</label>
                    <div class="relative">
                        <span aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-green-500">
                            <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current"><path d="M12.04 2a9.9 9.9 0 0 0-8.5 15.05L2 22l5.1-1.5A9.9 9.9 0 1 0 12.04 2Zm0 18.1a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.02.9.9-2.95-.2-.3a8.2 8.2 0 1 1 6.82 3.68Z"/></svg>
                        </span>
                        <input type="url" id="whatsapp_lien" name="whatsapp_lien" placeholder="https://chat.whatsapp.com/..."
                               value="{{ old('whatsapp_lien', $parametres['whatsapp_lien']) }}" required
                               class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-4 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                    </div>
                    <p class="mt-1.5 text-xs text-gray-500">
                        Utilisé par le bouton flottant, la page WhatsApp et la redirection après inscription.
                    </p>
                </div>

                {{-- Places disponibles --}}
                <div>
                    <label for="places_disponibles" class="mb-1.5 block text-sm font-bold text-itf-dark">Places disponibles ce mois-ci</label>
                    <div class="relative">
                        <input type="number" id="places_disponibles" name="places_disponibles" min="0"
                               value="{{ old('places_disponibles', $parametres['places_disponibles']) }}" required
                               class="w-full rounded-xl border border-gray-300 py-3 pl-4 pr-20 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                        <span aria-hidden="true" class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-sm font-bold text-gray-400">places</span>
                    </div>
                    <p class="mt-1.5 text-xs text-gray-500">
                        Affiché dans le bandeau d'urgence en haut du site et dans le pop-up d'inscription.
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== Barre d'action ===== --}}
        <div class="flex items-center justify-between gap-4 rounded-2xl border border-gray-100 bg-white p-4 shadow-sm">
            <p class="text-xs text-gray-500">
                💡 Pensez à vérifier le rendu sur le site après enregistrement.
            </p>
            <button type="submit"
                    class="inline-flex shrink-0 items-center gap-2 rounded-xl bg-itf-blue px-6 py-3 font-bold text-itf-white shadow-lg shadow-itf-blue/25 transition hover:-translate-y-0.5 hover:shadow-xl">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Enregistrer les paramètres
            </button>
        </div>
    </form>

</x-admin-layout>