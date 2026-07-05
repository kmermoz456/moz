<x-app-layout
    title="Connexion — ITF"
    description="Connectez-vous à votre espace étudiant ITF pour accéder à vos cours, quiz et documents.">

    <section class="relative min-h-screen overflow-hidden bg-itf-cream px-4 py-16">

        {{-- Décor de fond : halos + points, cohérent avec les autres pages --}}
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -left-32 top-10 h-80 w-80 rounded-full bg-itf-blue/10 blur-3xl"></div>
            <div class="absolute -right-24 bottom-10 h-96 w-96 rounded-full bg-itf-blue/10 blur-3xl"></div>
            <svg class="absolute right-[12%] top-16 hidden h-32 w-32 text-itf-blue/10 lg:block" fill="currentColor" viewBox="0 0 100 100">
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
                <h1 class="mt-4 text-2xl font-extrabold">Bon retour ! 👋</h1>
                <p class="mt-1 text-sm text-itf-cream/90">Connectez-vous pour accéder à votre espace ITF</p>
            </div>

            {{-- Formulaire --}}
            <form method="POST" action="{{ route('connexion') }}" class="space-y-5 p-8">
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

                {{-- Email --}}
                <div>
                    <label for="email" class="mb-1.5 block text-sm font-bold text-itf-dark">Email</label>
                    <div class="relative">
                        <span aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.9 5.3a2 2 0 0 0 2.2 0L21 8M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z"/>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="vous@exemple.com"
                               class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-4 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                    </div>
                </div>

                {{-- Mot de passe avec bouton afficher/masquer --}}
                <div x-data="{ voir: false }">
                    <label for="password" class="mb-1.5 block text-sm font-bold text-itf-dark">Mot de passe</label>
                    <div class="relative">
                        <span aria-hidden="true" class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 0 0-8 0v4M6 11h12a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2Z"/>
                            </svg>
                        </span>
                        <input :type="voir ? 'text' : 'password'" id="password" name="password" required
                               placeholder="••••••••"
                               class="w-full rounded-xl border border-gray-300 py-3 pl-12 pr-12 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                        <button type="button" @click="voir = !voir"
                                class="absolute right-3 top-1/2 -translate-y-1/2 rounded-lg p-1.5 text-gray-400 transition hover:text-itf-blue"
                                :aria-label="voir ? 'Masquer le mot de passe' : 'Afficher le mot de passe'">
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

                {{-- Se souvenir de moi --}}
                <label for="remember" class="flex w-fit cursor-pointer items-center gap-2.5">
                    <input type="checkbox" id="remember" name="remember"
                           class="h-4 w-4 rounded border-gray-300 text-itf-blue focus:ring-itf-blue">
                    <span class="text-sm text-itf-dark">Se souvenir de moi</span>
                </label>

                {{-- Bouton --}}
                <button type="submit"
                        class="group flex w-full items-center justify-center gap-2 rounded-xl bg-itf-blue py-4 font-bold text-itf-white shadow-lg shadow-itf-blue/25 transition hover:-translate-y-0.5 hover:shadow-xl">
                    Se connecter
                    <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 6l6 6-6 6M5 12h14"/>
                    </svg>
                </button>

                {{-- Lien inscription --}}
                <div class="border-t border-gray-100 pt-5 text-center text-sm text-gray-500">
                    Pas encore de compte ?
                    <a href="{{ route('inscription') }}" class="font-bold text-itf-blue hover:underline">
                        S'inscrire — 1 mois gratuit
                    </a>
                </div>
            </form>
        </div>

        {{-- Réassurance sous la carte --}}
        <p class="relative mx-auto mt-6 max-w-lg text-center text-xs text-gray-500">
            🔒 Vos informations sont protégées. Un problème pour vous connecter ?
            <a href="{{ route('whatsapp') }}" class="font-semibold text-itf-blue hover:underline">Écrivez-nous sur WhatsApp</a>
        </p>
    </section>

</x-app-layout>