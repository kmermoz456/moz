@csrf
@if (isset($cours))
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
        <input type="text" name="titre" value="{{ old('titre', $cours->titre ?? '') }}" required
               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">Description</label>
        <textarea name="description" rows="3"
                  class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">{{ old('description', $cours->description ?? '') }}</textarea>
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Niveau</label>
            <select name="niveau" required class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                <option value="L1" @selected(old('niveau', $cours->niveau ?? '') === 'L1')>L1</option>
                <option value="L2" @selected(old('niveau', $cours->niveau ?? '') === 'L2')>L2</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Matière</label>
            <input type="text" name="matiere" value="{{ old('matiere', $cours->matiere ?? '') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
        </div>
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">
            Fichier PDF @if (isset($cours)) (laisser vide pour conserver l'actuel) @endif
        </label>
        <input type="file" name="fichier_pdf" accept="application/pdf"
               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
    </div>

    <label class="flex items-center gap-2">
        <input type="checkbox" name="gratuit" value="1" @checked(old('gratuit', $cours->gratuit ?? false))
               class="rounded border-gray-300 text-itf-blue focus:ring-itf-blue">
        <span class="text-itf-dark">Cours gratuit (toujours accessible)</span>
    </label>

    <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
        {{ isset($cours) ? 'Mettre à jour' : 'Créer le cours' }}
    </button>
</div>
