@csrf
@if (isset($cours))
    @method('PUT')
@endif

@php
    $input = 'w-full rounded-lg border-gray-300 shadow-sm focus:border-itf-blue focus:ring-itf-blue';
@endphp

{{-- Erreurs de validation --}}
@if ($errors->any())
    <div class="flex gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm mb-6">
        <svg class="h-5 w-5 shrink-0 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        <div>
            <p class="font-semibold mb-1">Merci de corriger les points suivants :</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">

    <div>
        <label class="block font-semibold text-itf-dark mb-1">Titre <span class="text-red-500">*</span></label>
        <input type="text" name="titre" value="{{ old('titre', $cours->titre ?? '') }}" required
               placeholder="Ex. : Introduction à l'algorithmique"
               class="{{ $input }}">
    </div>

    <div>
        <label class="block font-semibold text-itf-dark mb-1">Description</label>
        <textarea name="description" rows="3" placeholder="Résumé court du contenu du cours…"
                  class="{{ $input }}">{{ old('description', $cours->description ?? '') }}</textarea>
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Niveau <span class="text-red-500">*</span></label>
            <select name="niveau" required class="{{ $input }}">
                <option value="L1" @selected(old('niveau', $cours->niveau ?? '') === 'L1')>L1</option>
                <option value="L2" @selected(old('niveau', $cours->niveau ?? '') === 'L2')>L2</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Matière <span class="text-red-500">*</span></label>
            <input type="text" name="matiere" value="{{ old('matiere', $cours->matiere ?? '') }}" required
                   placeholder="Ex. : Mathématiques"
                   class="{{ $input }}">
        </div>
    </div>

    {{-- Fichier PDF --}}
    <div x-data="{ fileName: '' }">
        <label class="block font-semibold text-itf-dark mb-1">
            Fichier PDF
            @if (isset($cours)) <span class="font-normal text-gray-400">(laisser vide pour conserver l'actuel)</span> @endif
        </label>

        {{-- Fichier déjà associé --}}
        @if (isset($cours) && ($cours->fichier_pdf ?? false))
            <div class="flex items-center gap-2 mb-2 text-sm text-gray-600 bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                <svg class="h-5 w-5 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
                <span class="truncate">{{ basename($cours->fichier_pdf) }}</span>
                <span class="text-gray-400">— fichier actuel</span>
            </div>
        @endif

        <label class="flex flex-col items-center justify-center gap-2 w-full cursor-pointer rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 px-4 py-6 text-center transition hover:border-itf-blue hover:bg-itf-blue/5"
               @dragover.prevent @drop.prevent="$refs.pdf.files = $event.dataTransfer.files; fileName = $refs.pdf.files[0]?.name || ''">
            <input type="file" name="fichier_pdf" accept="application/pdf" class="hidden" x-ref="pdf"
                   @change="fileName = $refs.pdf.files[0]?.name || ''">
            <svg class="h-7 w-7 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
            </svg>
            <span class="text-sm text-gray-600" x-show="!fileName">Cliquez ou glissez un PDF ici</span>
            <span class="text-sm font-medium text-itf-blue" x-show="fileName" x-text="fileName" x-cloak></span>
            <span class="text-xs text-gray-400">PDF uniquement</span>
        </label>
    </div>

    {{-- Cours gratuit --}}
    <label class="flex items-start gap-3 rounded-xl border border-gray-200 bg-gray-50 p-4 cursor-pointer hover:border-itf-blue/40 transition">
        <input type="checkbox" name="gratuit" value="1" @checked(old('gratuit', $cours->gratuit ?? false))
               class="mt-0.5 rounded border-gray-300 text-itf-blue focus:ring-itf-blue">
        <span>
            <span class="block font-medium text-itf-dark">Cours gratuit</span>
            <span class="block text-sm text-gray-500">Toujours accessible, sans paiement requis.</span>
        </span>
    </label>

    {{-- Actions --}}
    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
            {{ isset($cours) ? 'Mettre à jour' : 'Créer le cours' }}
        </button>
        <a href="{{ route('admin.cours.index') }}" class="px-6 py-3 rounded-lg font-medium text-gray-600 hover:bg-gray-100 transition">
            Annuler
        </a>
    </div>
</div>