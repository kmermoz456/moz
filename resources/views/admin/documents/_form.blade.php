@csrf
@if (isset($document))
    @method('PUT')
@endif

@if ($errors->any())
    <div class="flex gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm mb-6">
        <svg class="w-5 h-5 shrink-0 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
        </svg>
        <div>
            <p class="font-semibold mb-1">Merci de corriger {{ $errors->count() > 1 ? 'les points suivants' : 'le point suivant' }} :</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div x-data="{
        preview: '{{ isset($document) && $document->image ? asset('storage/'.$document->image) : '' }}',
        prix: {{ old('prix', $document->prix ?? 0) }},
        onFile(e) {
            const file = e.target.files[0];
            if (file) this.preview = URL.createObjectURL(file);
        }
     }"
     class="space-y-6">

    {{-- Titre --}}
    <div>
        <label for="titre" class="block text-sm font-semibold text-itf-dark mb-1.5">Titre</label>
        <input id="titre" type="text" name="titre" value="{{ old('titre', $document->titre ?? '') }}" required
               placeholder="Ex : Recueil d'anciens sujets — Biologie cellulaire"
               class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                      placeholder-itf-dark/30 shadow-sm transition-colors duration-200
                      hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block text-sm font-semibold text-itf-dark mb-1.5">
            Description <span class="font-normal text-itf-dark/40">(optionnel)</span>
        </label>
        <textarea id="description" name="description" rows="3"
                  placeholder="Décrivez brièvement le contenu du document…"
                  class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                         placeholder-itf-dark/30 shadow-sm resize-y transition-colors duration-200
                         hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none"
        >{{ old('description', $document->description ?? '') }}</textarea>
    </div>

    {{-- Catégorie / Niveau / Prix --}}
    <div class="grid sm:grid-cols-3 gap-4">
        <div>
            <label for="categorie" class="block text-sm font-semibold text-itf-dark mb-1.5">Catégorie</label>
            <input id="categorie" type="text" name="categorie" value="{{ old('categorie', $document->categorie ?? '') }}" required
                   placeholder="Ex : Recueil d'anciens sujets"
                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                          placeholder-itf-dark/30 shadow-sm transition-colors duration-200
                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
        </div>

        <div>
            <label for="niveau" class="block text-sm font-semibold text-itf-dark mb-1.5">Niveau</label>
            <select id="niveau" name="niveau" required
                    class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                           shadow-sm transition-colors duration-200 appearance-none
                           hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                @foreach (['Tous', 'L1', 'L2'] as $niveau)
                    <option value="{{ $niveau }}" @selected(old('niveau', $document->niveau ?? 'Tous') === $niveau)>{{ $niveau }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="prix" class="block text-sm font-semibold text-itf-dark mb-1.5">Prix (FCFA)</label>
            <div class="relative">
                <input id="prix" type="number" name="prix" min="0" x-model.number="prix"
                       value="{{ old('prix', $document->prix ?? '') }}" required
                       class="w-full rounded-xl border border-itf-dark/15 bg-itf-white pl-4 pr-16 py-2.5 text-itf-dark
                              shadow-sm transition-colors duration-200
                              hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-semibold text-itf-dark/35">FCFA</span>
            </div>
        </div>
    </div>

    {{-- Photo --}}
    <div>
        <label class="block text-sm font-semibold text-itf-dark mb-1.5">
            Photo
            @if (isset($document))
                <span class="font-normal text-itf-dark/50">(laisser vide pour conserver l'actuelle)</span>
            @else
                <span class="font-normal text-itf-dark/40">(optionnel)</span>
            @endif
        </label>

        <div class="flex items-center gap-4">
            <div class="shrink-0 w-24 h-24 rounded-xl overflow-hidden bg-itf-cream border border-itf-dark/10 flex items-center justify-center">
                <template x-if="preview">
                    <img :src="preview" class="w-full h-full object-cover" alt="Aperçu">
                </template>
                <template x-if="!preview">
                    <svg class="w-8 h-8 text-itf-dark/25" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                </template>
            </div>

            <label for="image"
                   class="flex-1 flex flex-col items-center justify-center gap-1 h-24 rounded-xl border-2 border-dashed
                          border-itf-dark/20 bg-itf-white cursor-pointer transition-colors duration-200
                          hover:border-itf-blue hover:bg-itf-blue/5">
                <svg class="w-5 h-5 text-itf-dark/40" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9m0 0l-3.75 3.75M12 9l3.75 3.75M6.75 19.5h10.5a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15l-1.5-2h-3l-1.5 2H6.75a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25z"/>
                </svg>
                <span class="text-xs text-itf-dark/50">Cliquer pour choisir un fichier</span>
                <input id="image" type="file" name="image" accept="image/*" @change="onFile" class="hidden">
            </label>
        </div>
    </div>

    {{-- Disponibilité --}}
    <label for="disponible" class="flex items-center justify-between gap-3 rounded-xl border border-itf-dark/10 bg-itf-cream/50 px-4 py-3 cursor-pointer">
        <span>
            <span class="block text-sm font-semibold text-itf-dark">Disponible à la commande</span>
            <span class="block text-xs text-itf-dark/50">Visible et achetable immédiatement dans le catalogue</span>
        </span>
        <span class="relative inline-flex items-center">
            <input id="disponible" type="checkbox" name="disponible" value="1"
                   @checked(old('disponible', $document->disponible ?? true))
                   class="peer sr-only">
            <span class="w-11 h-6 rounded-full bg-itf-dark/20 peer-checked:bg-itf-blue transition-colors duration-200"></span>
            <span class="absolute left-1 top-1 w-4 h-4 rounded-full bg-itf-white shadow transition-transform duration-200 peer-checked:translate-x-5"></span>
        </span>
    </label>

    {{-- Actions --}}
    <div class="flex items-center gap-3 pt-2">
        <button type="submit"
                class="inline-flex items-center gap-2 bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-xl
                       shadow-md shadow-itf-blue/25 transition-all duration-300
                       hover:shadow-lg hover:shadow-itf-blue/35 hover:-translate-y-0.5 active:translate-y-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ isset($document) ? 'Mettre à jour' : 'Ajouter au catalogue' }}
        </button>

        <span class="text-sm text-itf-dark/40" x-show="prix > 0" x-cloak>
            Prix affiché : <span class="font-semibold text-itf-dark/60" x-text="new Intl.NumberFormat('fr-FR').format(prix) + ' FCFA'"></span>
        </span>
    </div>
</div>