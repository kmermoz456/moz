@csrf
@if (isset($document))
    @method('PUT')
@endif

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
    <div>
        <label class="block font-semibold text-itf-dark mb-1">Titre</label>
        <input type="text" name="titre" value="{{ old('titre', $document->titre ?? '') }}" required
               placeholder="Ex : Recueil d'anciens sujets — Biologie cellulaire"
               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">Description</label>
        <textarea name="description" rows="3"
                  class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">{{ old('description', $document->description ?? '') }}</textarea>
    </div>

    <div class="grid sm:grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Catégorie</label>
            <input type="text" name="categorie" value="{{ old('categorie', $document->categorie ?? '') }}" required
                   placeholder="Ex : Recueil d'anciens sujets"
                   class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
        </div>
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Niveau</label>
            <select name="niveau" required class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                @foreach (['Tous', 'L1', 'L2'] as $niveau)
                    <option value="{{ $niveau }}" @selected(old('niveau', $document->niveau ?? 'Tous') === $niveau)>{{ $niveau }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Prix (FCFA)</label>
            <input type="number" name="prix" min="0" value="{{ old('prix', $document->prix ?? '') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
        </div>
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">
            Photo @if (isset($document)) (laisser vide pour conserver l'actuelle) @endif
        </label>
        @if (isset($document) && $document->image)
            <img src="{{ asset('storage/'.$document->image) }}" alt="{{ $document->titre }}" class="w-24 h-24 object-cover rounded-lg mb-2">
        @endif
        <input type="file" name="image" accept="image/*"
               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
    </div>

    <label class="flex items-center gap-2">
        <input type="checkbox" name="disponible" value="1" @checked(old('disponible', $document->disponible ?? true))
               class="rounded border-gray-300 text-itf-blue focus:ring-itf-blue">
        <span class="text-itf-dark">Disponible à la commande</span>
    </label>

    <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
        {{ isset($document) ? 'Mettre à jour' : 'Ajouter au catalogue' }}
    </button>
</div>
