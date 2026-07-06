@csrf
@if (isset($actualite))
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
        image: null,
        preview: '{{ isset($actualite) && $actualite->image ? asset('storage/'.$actualite->image) : '' }}',
        onFile(e) {
            const file = e.target.files[0];
            if (file) this.preview = URL.createObjectURL(file);
        }
     }"
     class="space-y-6">

    {{-- Titre --}}
    <div>
        <label for="titre" class="block text-sm font-semibold text-itf-dark mb-1.5">Titre</label>
        <input id="titre" type="text" name="titre" value="{{ old('titre', $actualite->titre ?? '') }}" required
               placeholder="Ex : Ouverture des inscriptions 2026"
               class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                      placeholder-itf-dark/30 shadow-sm transition-colors duration-200
                      hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
    </div>

    {{-- Contenu --}}
    <div>
        <label for="contenu" class="block text-sm font-semibold text-itf-dark mb-1.5">Contenu</label>
        <textarea id="contenu" name="contenu" rows="6" required
                  placeholder="Rédigez le contenu de l'actualité…"
                  class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                         placeholder-itf-dark/30 shadow-sm resize-y transition-colors duration-200
                         hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none"
        >{{ old('contenu', $actualite->contenu ?? '') }}</textarea>
    </div>

    {{-- Image --}}
    <div>
        <label class="block text-sm font-semibold text-itf-dark mb-1.5">
            Image
            @if (isset($actualite))
                <span class="font-normal text-itf-dark/50">(laisser vide pour conserver l'actuelle)</span>
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
                              d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M16.5 6a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM2.25 6.75a2.25 2.25 0 012.25-2.25h15a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75z"/>
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

    {{-- Publication --}}
    <label for="publie" class="flex items-center justify-between gap-3 rounded-xl border border-itf-dark/10 bg-itf-cream/50 px-4 py-3 cursor-pointer">
        <span>
            <span class="block text-sm font-semibold text-itf-dark">Publiée sur le site</span>
            <span class="block text-xs text-itf-dark/50">Visible immédiatement par les visiteurs</span>
        </span>
        <span class="relative inline-flex items-center">
            <input id="publie" type="checkbox" name="publie" value="1"
                   @checked(old('publie', $actualite->publie ?? true))
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
            {{ isset($actualite) ? 'Mettre à jour' : "Publier l'actualité" }}
        </button>
    </div>
</div>