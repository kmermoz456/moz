<x-app-layout>

    @php
        $libelles = [
            'en_attente' => ['label' => 'En attente', 'classe' => 'bg-amber-100 text-amber-700'],
            'confirmee'  => ['label' => 'Confirmée', 'classe' => 'bg-blue-100 text-blue-700'],
            'prete'      => ['label' => 'Prête', 'classe' => 'bg-purple-100 text-purple-700'],
            'livree'     => ['label' => 'Livrée', 'classe' => 'bg-green-100 text-green-700'],
            'annulee'    => ['label' => 'Annulée', 'classe' => 'bg-red-100 text-red-700'],
        ];
    @endphp

    <section class="mx-auto max-w-4xl px-4 py-10">
        <a href="{{ route('etudiant.documents.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour au catalogue</a>
        <h1 class="mt-2 mb-6 text-2xl font-bold text-itf-dark">🧾 Mes commandes de documents</h1>

        @forelse ($commandes as $commande)
            <div class="mb-4 flex flex-col gap-3 rounded-2xl border border-gray-200 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-bold text-itf-dark">{{ $commande->document->titre ?? 'Document supprimé' }}</p>
                    <p class="text-sm text-gray-500">
                        Quantité : {{ $commande->quantite }} — Total : {{ number_format($commande->total(), 0, ',', ' ') }} FCFA
                    </p>
                    @if ($commande->notes)
                        <p class="mt-1 text-xs italic text-gray-400">« {{ $commande->notes }} »</p>
                    @endif
                    <p class="mt-1 text-xs text-gray-400">Commandé le {{ $commande->created_at->translatedFormat('d F Y') }}</p>
                </div>
                <span class="w-fit rounded-full px-3 py-1 text-xs font-bold {{ $libelles[$commande->statut]['classe'] }}">
                    {{ $libelles[$commande->statut]['label'] }}
                </span>
            </div>
        @empty
            <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-itf-cream/40 p-12 text-center">
                <span class="text-5xl">📭</span>
                <p class="mt-4 font-bold text-itf-dark">Vous n'avez pas encore commandé de document</p>
                <a href="{{ route('etudiant.documents.index') }}" class="mt-4 inline-block rounded-xl bg-itf-blue px-6 py-3 font-bold text-itf-white transition hover:opacity-90">
                    Voir le catalogue
                </a>
            </div>
        @endforelse

        <div class="mt-6">{{ $commandes->links() }}</div>
    </section>

</x-app-layout>
