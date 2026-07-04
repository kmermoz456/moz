<x-app-layout>
    <section class="min-h-[70vh] bg-itf-cream flex items-center py-16 px-4"
             x-data="{ secondes: 5 }"
             x-init="setInterval(() => { if (secondes > 0) secondes--; if (secondes === 0) window.open('{{ $lienWhatsapp }}', '_blank') }, 1000)">
        <div class="max-w-lg mx-auto bg-itf-white rounded-2xl shadow-lg p-10 text-center">
            <span class="text-5xl">🎉</span>
            <h1 class="text-2xl font-bold text-itf-dark mt-4">Bienvenue chez ITF !</h1>
            <p class="mt-3 text-gray-700">
                Votre compte a été créé et votre <strong>mois de renforcement gratuit</strong> est activé.
                Rejoignez maintenant le groupe WhatsApp pour ne rien manquer.
            </p>
            <p class="mt-4 text-sm text-gray-500">
                Ouverture automatique de WhatsApp dans <span x-text="secondes" class="font-bold text-itf-blue"></span> secondes...
            </p>
            <a href="{{ $lienWhatsapp }}" target="_blank" rel="noopener"
               class="inline-block mt-6 bg-green-500 text-itf-white font-bold px-8 py-4 rounded-lg hover:opacity-90 transition">
                💬 Rejoindre le groupe WhatsApp
            </a>
            <div class="mt-4">
                <a href="{{ route('etudiant.dashboard') }}" class="text-itf-blue font-semibold hover:underline">
                    Accéder à mon espace →
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
