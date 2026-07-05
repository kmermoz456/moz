<x-app-layout>

    {{-- ================= En-tête ================= --}}
    <section class="relative overflow-hidden bg-itf-blue text-itf-white">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-itf-cream/10 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-6xl px-4 py-12">
            <p class="text-xs font-bold uppercase tracking-widest text-itf-cream/80">Espace étudiant</p>
            <h1 class="mt-1 text-2xl font-extrabold sm:text-3xl">📦 Commander des documents physiques</h1>
            <p class="mt-2 max-w-2xl text-itf-cream/90">
                Recueils d'anciens sujets, fiches de révision, livrets de TD... Commandez vos supports papier,
                nous vous contactons sur WhatsApp pour la remise et le règlement.
            </p>
            <a href="{{ route('etudiant.commandes.index') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-itf-cream hover:text-itf-white hover:underline">
                🧾 Voir mes commandes →
            </a>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-10">
        @forelse ($documents as $categorie => $documentsCategorie)
            <div class="mb-12">
                <div class="mb-5 flex items-center gap-3">
                    <h2 class="text-lg font-bold text-itf-blue">{{ $categorie }}</h2>
                    <div aria-hidden="true" class="h-px flex-1 bg-gray-200"></div>
                </div>

                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($documentsCategorie as $document)
                        <div x-data="{ commander: false }"
                             class="flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-itf-white transition hover:shadow-lg">
                            @if ($document->image)
                                <img src="{{ asset('storage/'.$document->image) }}" alt="{{ $document->titre }}" class="h-40 w-full object-cover">
                            @else
                                <div class="grid h-40 w-full place-items-center bg-itf-cream text-5xl">📘</div>
                            @endif

                            <div class="flex flex-1 flex-col p-5">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-bold text-itf-dark">{{ $document->titre }}</h3>
                                    <span class="shrink-0 rounded-full bg-itf-cream px-2.5 py-0.5 text-xs font-bold text-itf-dark">{{ $document->niveau }}</span>
                                </div>

                                @if ($document->description)
                                    <p class="mt-2 flex-1 text-sm text-gray-600">{{ $document->description }}</p>
                                @endif

                                <p class="mt-3 text-lg font-extrabold text-itf-blue">{{ number_format($document->prix, 0, ',', ' ') }} FCFA</p>

                                <button @click="commander = !commander" type="button"
                                        class="mt-4 rounded-xl bg-itf-blue px-4 py-2.5 text-sm font-bold text-itf-white transition hover:opacity-90">
                                    <span x-text="commander ? 'Annuler' : 'Commander'"></span>
                                </button>

                                <form x-show="commander" x-cloak method="POST" action="{{ route('etudiant.documents.commander', $document) }}" class="mt-4 space-y-3">
                                    @csrf
                                    <div>
                                        <label class="mb-1 block text-xs font-semibold text-itf-dark">Quantité</label>
                                        <input type="number" name="quantite" value="1" min="1" max="20" required
                                               class="w-full rounded-lg border-gray-300 text-sm focus:border-itf-blue focus:ring-itf-blue">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-xs font-semibold text-itf-dark">Note (facultatif)</label>
                                        <input type="text" name="notes" maxlength="500" placeholder="Ex : à retirer après 16h"
                                               class="w-full rounded-lg border-gray-300 text-sm focus:border-itf-blue focus:ring-itf-blue">
                                    </div>
                                    <button type="submit" class="w-full rounded-xl bg-green-500 px-4 py-2.5 text-sm font-bold text-itf-white transition hover:bg-green-600">
                                        Confirmer la commande
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="rounded-2xl border-2 border-dashed border-gray-200 bg-itf-cream/40 p-12 text-center">
                <span class="text-5xl">📭</span>
                <p class="mt-4 font-bold text-itf-dark">Aucun document disponible pour le moment</p>
                <p class="mx-auto mt-1 max-w-sm text-sm text-gray-600">
                    Revenez bientôt ou contactez-nous sur WhatsApp pour vos besoins en documents physiques.
                </p>
            </div>
        @endforelse
    </section>

</x-app-layout>
