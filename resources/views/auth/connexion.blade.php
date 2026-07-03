<x-app-layout>
    <section class="min-h-screen bg-itf-cream py-16 px-4">
        <div class="max-w-lg mx-auto bg-itf-white rounded-2xl shadow-lg overflow-hidden">

            {{-- En-tête --}}
            <div class="bg-itf-blue text-itf-white p-8 text-center">
                <h1 class="text-2xl font-bold">Connexion</h1>
                <p class="mt-2 text-itf-cream">Accédez à votre espace ITF</p>
            </div>

            {{-- Formulaire --}}
            <form method="POST" action="{{ route('connexion') }}" class="p-8 space-y-5">
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
                    <label for="email" class="block font-semibold text-itf-dark mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label for="password" class="block font-semibold text-itf-dark mb-1">Mot de passe</label>
                    <input type="password" id="password" name="password" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                           class="rounded border-gray-300 text-itf-blue focus:ring-itf-blue">
                    <label for="remember" class="ml-2 text-sm text-itf-dark">Se souvenir de moi</label>
                </div>

                <button type="submit"
                        class="w-full bg-itf-blue text-itf-white font-bold py-4 rounded-lg hover:opacity-90 transition">
                    Se connecter
                </button>

                <p class="text-center text-sm text-gray-500">
                    Pas encore de compte ? <a href="{{ route('inscription') }}" class="text-itf-blue font-semibold">S'inscrire — 1 mois gratuit</a>
                </p>
            </form>
        </div>
    </section>
</x-app-layout>
