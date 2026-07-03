<x-app-layout>
    <section class="min-h-screen bg-itf-cream py-16 px-4">
        <div class="max-w-lg mx-auto bg-itf-white rounded-2xl shadow-lg overflow-hidden">

            {{-- En-tête --}}
            <div class="bg-itf-blue text-itf-white p-8 text-center">
                <h1 class="text-2xl font-bold">Créer mon compte ITF</h1>
                <p class="mt-2 text-itf-cream">🎁 1 mois de renforcement gratuit offert</p>
            </div>

            {{-- Formulaire --}}
            <form method="POST" action="{{ route('inscription') }}" class="p-8 space-y-5">
                @csrf

                {{-- Erreurs de validation --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-4 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="name" class="block font-semibold text-itf-dark mb-1">Nom</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label for="prenoms" class="block font-semibold text-itf-dark mb-1">Prénoms</label>
                    <input type="text" id="prenoms" name="prenoms" value="{{ old('prenoms') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label for="email" class="block font-semibold text-itf-dark mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label for="telephone" class="block font-semibold text-itf-dark mb-1">Téléphone (WhatsApp)</label>
                    <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}"
                           placeholder="07 00 00 00 00" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                {{-- Choix du niveau avec Alpine --}}
                <div x-data="{ niveau: '{{ old('niveau', 'L1') }}' }">
                    <label class="block font-semibold text-itf-dark mb-2">Niveau</label>
                    <input type="hidden" name="niveau" :value="niveau">
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" @click="niveau = 'L1'"
                                :class="niveau === 'L1' ? 'bg-itf-blue text-itf-white' : 'bg-itf-cream text-itf-dark'"
                                class="py-3 rounded-lg font-bold transition">
                            Licence 1
                        </button>
                        <button type="button" @click="niveau = 'L2'"
                                :class="niveau === 'L2' ? 'bg-itf-blue text-itf-white' : 'bg-itf-cream text-itf-dark'"
                                class="py-3 rounded-lg font-bold transition">
                            Licence 2
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password" class="block font-semibold text-itf-dark mb-1">Mot de passe</label>
                    <input type="password" id="password" name="password" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label for="password_confirmation" class="block font-semibold text-itf-dark mb-1">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <button type="submit"
                        class="w-full bg-itf-blue text-itf-white font-bold py-4 rounded-lg hover:opacity-90 transition">
                    Créer mon compte et activer mon mois gratuit
                </button>

                <p class="text-center text-sm text-gray-500">
                    Déjà inscrit ? <a href="{{ route('login') }}" class="text-itf-blue font-semibold">Se connecter</a>
                </p>
            </form>
        </div>
    </section>
</x-app-layout>