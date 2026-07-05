<x-app-layout
    title="Inscription — 1 mois gratuit — ITF"
    description="Inscrivez-vous à Intellect Tronc SN Formation et bénéficiez d'un mois de renforcement académique gratuit en Sciences de la Nature.">

    <section class="relative min-h-screen overflow-hidden bg-itf-cream px-4 py-16">

        {{-- Décor de fond : identique à la page de connexion --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-32 top-10 h-80 w-80 rounded-full bg-itf-blue/10 blur-3xl"></div>
            <div class="absolute -right-24 bottom-10 h-96 w-96 rounded-full bg-itf-blue/10 blur-3xl"></div>
            <svg class="absolute left-[10%] bottom-20 hidden h-32 w-32 text-itf-blue/10 lg:block" fill="currentColor" viewBox="0 0 100 100">
                @for ($x = 0; $x < 8; $x++) @for ($y = 0; $y < 8; $y++)
                    <circle cx="{{ 6 + $x * 12 }}" cy="{{ 6 + $y * 12 }}" r="1.8" />
                @endfor @endfor
            </svg>
        </div>

        <div class="relative mx-auto max-w-lg overflow-hidden rounded-3xl bg-itf-white shadow-xl">

            {{-- En-tête --}}
            <div class="relative overflow-hidden bg-itf-blue p-8 text-center text-itf-white">
                <div aria-hidden="true" class="pointer-events-none absolute -right-10 -top-10 h-40 w-40 rounded-full bg-itf-cream/10 blur-2xl"></div>

                {{-- Logo ITF --}}
                <span class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-itf-white p-2 shadow-lg">
                    <img src="{{ asset('images/icon_ITF.png') }}" alt="Logo ITF" class="h-full w-full object-contain">
                </span>
                <h1 class="mt-4 text-2xl font-extrabold">Créer mon compte ITF</h1>
                <p class="mt-1 text-sm text-itf-cream/90">🎁 1 mois de renforcement gratuit offert</p>

                {{-- Réassurance --}}
                <div class="mt-4 flex flex-wrap items-center justify-center gap-x-4 gap-y-1 text-xs font-semibold text-itf-cream">
                    <span>✔ Sans engagement</span>
                    <span>✔ Accès immédiat</span>
                    <span>✔ 2 minutes chrono</span>
                </div>
            </div>

            {{-- Formulaire --}}
            <form method="POST" action="{{ route('inscription') }}" class="space-y-5 p-8">
                @csrf

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

                {{-- Nom + Prénoms sur une ligne --}}
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-bold text-itf-dark">Nom</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               placeholder="Kouassi"
                               class="w-full rounded-xl border border-gray-300 px-4 py-3 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                    </div>
                    <div>
                        <label for="prenoms" class="mb-1.5 block text-sm font-bold text-itf-dark">Prénoms</label>
                        <input type="text" id="prenoms" name="prenoms" value="{{ old('prenoms') }}" required
                               placeholder="Aya Marie"
                               class="w-full rounded-xl border border-gray-300 px-4 py-3 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-bold text-itf-dark">Email</label>
                    <div class="relative">
                        <span aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.9 5.3a2 2 0 0 0 2.2 0L21 8M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z"/>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               placeholder="vous@exemple.com"
                               class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-4 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                    </div>
                </div>

                {{-- Téléphone --}}
                <div>
                    <label for="telephone" class="mb-1.5 block text-sm font-bold text-itf-dark">Téléphone (WhatsApp)</label>
                    <div class="relative">
                        <span aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg viewBox="0 0 24 24" class="h-5 w-5 fill-current" aria-hidden="true"><path d="M12.04 2a9.9 9.9 0 0 0-8.5 15.05L2 22l5.1-1.5A9.9 9.9 0 1 0 12.04 2Zm0 18.1a8.2 8.2 0 0 1-4.2-1.15l-.3-.18-3.02.9.9-2.95-.2-.3a8.2 8.2 0 1 1 6.82 3.68Z"/></svg>
                        </span>
                        <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}" required
                               placeholder="07 00 00 00 00"
                               class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-4 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                    </div>
                    <p class="mt-1.5 text-xs text-gray-500">C'est sur ce numéro que notre équipe vous contactera.</p>
                </div>

                {{-- Choix du niveau --}}
                <div x-data="{ niveau: '{{ old('niveau', 'L1') }}' }">
                    <label class="mb-2 block text-sm font-bold text-itf-dark">Votre niveau</label>
                    <input type="hidden" name="niveau" :value="niveau">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ([['L1', 'Licence 1', 'Nouveau bachelier ou redoublant'], ['L2', 'Licence 2', 'Tronc commun, 2e année']] as [$code, $libelle, $sous])
                            <button type="button" @click="niveau = '{{ $code }}'"
                                    :class="niveau === '{{ $code }}'
                                        ? 'border-itf-blue bg-itf-blue text-itf-white shadow-lg shadow-itf-blue/25'
                                        : 'border-gray-200 bg-itf-white text-itf-dark hover:border-itf-blue/40'"
                                    :aria-pressed="niveau === '{{ $code }}'"
                                    class="relative rounded-xl border-2 p-4 text-left transition duration-200">
                                {{-- Coche visible quand sélectionné --}}
                                <span x-show="niveau === '{{ $code }}'" x-cloak
                                      class="absolute right-3 top-3 grid h-5 w-5 place-items-center rounded-full bg-itf-white text-xs font-extrabold text-itf-blue">✓</span>
                                <span class="block font-extrabold">{{ $libelle }}</span>
                                <span class="mt-0.5 block text-xs"
                                      :class="niveau === '{{ $code }}' ? 'text-itf-cream/90' : 'text-gray-500'">{{ $sous }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Mots de passe avec affichage/masquage partagé --}}
                <div x-data="{ voir: false }" class="space-y-5">
                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-bold text-itf-dark">Mot de passe</label>
                        <div class="relative">
                            <span aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 0 0-8 0v4M6 11h12a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2Z"/>
                                </svg>
                            </span>
                            <input :type="voir ? 'text' : 'password'" id="password" name="password" required
                                   placeholder="8 caractères minimum"
                                   class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-12 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                            <button type="button" @click="voir = !voir"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg p-1.5 text-gray-400 transition hover:text-itf-blue"
                                    :aria-label="voir ? 'Masquer les mots de passe' : 'Afficher les mots de passe'">
                                <svg x-show="!voir" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.4 12s3.6-7 9.6-7 9.6 7 9.6 7-3.6 7-9.6 7-9.6-7-9.6-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                                <svg x-show="voir" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.6a3 3 0 0 0 4.2 4.2M9.9 5.2A9.8 9.8 0 0 1 12 5c6 0 9.6 7 9.6 7a17.5 17.5 0 0 1-2.4 3.3M6.3 6.3A16.9 16.9 0 0 0 2.4 12s3.6 7 9.6 7a9.6 9.6 0 0 0 3.9-.8"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-1.5 block text-sm font-bold text-itf-dark">Confirmer le mot de passe</label>
                        <div class="relative">
                            <span aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </span>
                            <input :type="voir ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" required
                                   placeholder="Retapez le même mot de passe"
                                   class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-4 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                        </div>
                    </div>
                </div>

                {{-- Bouton --}}
                <button type="submit"
                        class="group flex w-full items-center justify-center gap-2 rounded-xl bg-itf-blue py-4 font-bold text-itf-white shadow-lg shadow-itf-blue/25 transition hover:-translate-y-0.5 hover:shadow-xl">
                    🎁 Créer mon compte et activer mon mois gratuit
                </button>

                {{-- Lien connexion --}}
                <div class="border-t border-gray-100 pt-5 text-center text-sm text-gray-500">
                    Déjà inscrit ?
                    <a href="{{ route('connexion') }}" class="font-bold text-itf-blue hover:underline">Se connecter</a>
                </div>
            </form>
        </div>

        {{-- Réassurance sous la carte --}}
        <p class="relative mx-auto mt-6 max-w-lg text-center text-xs text-gray-500">
            🔒 Vos informations restent confidentielles et ne sont jamais partagées.
            Une question ? <a href="{{ route('whatsapp') }}" class="font-semibold text-itf-blue hover:underline">Écrivez-nous sur WhatsApp</a>
        </p>
    </section>

</x-app-layout>