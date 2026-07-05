<x-admin-layout title="Nouvel administrateur — Back-office ITF">
    <a href="{{ route('admin.administrateurs.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour aux administrateurs</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Créer un administrateur</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-xl">
        <form method="POST" action="{{ route('admin.administrateurs.store') }}">
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
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-itf-dark mb-1">Nom</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                    </div>
                    <div>
                        <label class="block font-semibold text-itf-dark mb-1">Prénoms</label>
                        <input type="text" name="prenoms" value="{{ old('prenoms') }}" required
                               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Téléphone</label>
                    <input type="tel" name="telephone" value="{{ old('telephone') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold text-itf-dark mb-1">Mot de passe</label>
                        <input type="password" name="password" required
                               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                        <p class="text-xs text-gray-500 mt-1">8 caractères minimum.</p>
                    </div>
                    <div>
                        <label class="block font-semibold text-itf-dark mb-1">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                    </div>
                </div>

                <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
                    Créer l'administrateur
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
