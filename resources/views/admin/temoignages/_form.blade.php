@csrf
@if (isset($temoignage))
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
        <label class="block font-semibold text-itf-dark mb-1">Nom</label>
        <input type="text" name="nom" value="{{ old('nom', $temoignage->nom ?? '') }}" required
               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">Promotion</label>
        <input type="text" name="promotion" value="{{ old('promotion', $temoignage->promotion ?? '') }}" placeholder="Ex : Promotion L1 2025"
               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">Témoignage</label>
        <textarea name="contenu" rows="4" required
                  class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">{{ old('contenu', $temoignage->contenu ?? '') }}</textarea>
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">
            Photo @if (isset($temoignage)) (laisser vide pour conserver l'actuelle) @endif
        </label>
        <input type="file" name="photo" accept="image/*"
               class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
    </div>

    <label class="flex items-center gap-2">
        <input type="checkbox" name="publie" value="1" @checked(old('publie', $temoignage->publie ?? true))
               class="rounded border-gray-300 text-itf-blue focus:ring-itf-blue">
        <span class="text-itf-dark">Publié sur le site</span>
    </label>

    <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
        {{ isset($temoignage) ? 'Mettre à jour' : 'Ajouter le témoignage' }}
    </button>
</div>
