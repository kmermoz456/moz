<x-admin-layout title="Ajouter une photo — Back-office ITF">

    {{-- Fil de retour + titre --}}
    <a href="{{ route('admin.galerie.index') }}"
       class="group inline-flex items-center gap-1.5 text-sm font-semibold text-itf-blue hover:underline">
        <span class="transition group-hover:-translate-x-1">&larr;</span> Retour à la galerie
    </a>
    <div class="mb-8 mt-2">
        <h1 class="text-2xl font-extrabold text-itf-dark">Ajouter une photo</h1>
        <p class="mt-1 text-sm text-gray-500">La photo apparaîtra dans la galerie de la page d'accueil.</p>
    </div>

    <form method="POST" action="{{ route('admin.galerie.store') }}" enctype="multipart/form-data"
          class="max-w-xl space-y-6"
          x-data="{
              apercu: null,
              nomFichier: '',
              tailleFichier: '',
              charger(input) {
                  const f = input.files[0];
                  if (!f) return;
                  this.nomFichier = f.name;
                  this.tailleFichier = (f.size / 1024 / 1024).toFixed(2) + ' Mo';
                  const lecteur = new FileReader();
                  lecteur.onload = (e) => this.apercu = e.target.result;
                  lecteur.readAsDataURL(f);
              },
              retirer() {
                  this.$refs.fichier.value = '';
                  this.apercu = null;
                  this.nomFichier = '';
                  this.tailleFichier = '';
              }
          }">
        @csrf

        {{-- Erreurs de validation --}}
        @if ($errors->any())
            <div class="flex gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
                <span aria-hidden="true" class="text-lg leading-none">⚠️</span>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="space-y-5 p-6">

                {{-- Titre --}}
                <div>
                    <label for="titre" class="mb-1.5 block text-sm font-bold text-itf-dark">Titre de la photo</label>
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required
                           placeholder="Ex : Séance de renforcement L1, mars {{ date('Y') }}"
                           class="w-full rounded-xl border border-gray-300 px-4 py-3 transition focus:border-itf-blue focus:outline-none focus:ring-2 focus:ring-itf-blue/30">
                    <p class="mt-1.5 text-xs text-gray-500">Affiché au survol de la photo sur le site.</p>
                </div>

                {{-- Zone de dépôt d'image --}}
                <div>
                    <span class="mb-1.5 block text-sm font-bold text-itf-dark">Image</span>

                    {{-- État vide : zone cliquable + glisser-déposer --}}
                    <label x-show="!apercu"
                           for="fichier-image"
                           @dragover.prevent
                           @drop.prevent="$refs.fichier.files = $event.dataTransfer.files; charger($refs.fichier)"
                           class="flex cursor-pointer flex-col items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50/50 px-6 py-10 text-center transition hover:border-itf-blue/50 hover:bg-itf-blue/5">
                        <span class="grid h-14 w-14 place-items-center rounded-2xl bg-itf-blue/10 text-3xl">🖼️</span>
                        <span class="text-sm font-bold text-itf-dark">Cliquez pour choisir une image</span>
                        <span class="text-xs text-gray-500">ou glissez-déposez le fichier ici — JPG, PNG, WebP</span>
                    </label>

                    {{-- Aperçu après sélection --}}
                    <div x-show="apercu" x-cloak class="overflow-hidden rounded-2xl border border-gray-200">
                        <img :src="apercu" alt="Aperçu de l'image sélectionnée" class="max-h-72 w-full object-cover">
                        <div class="flex items-center justify-between gap-3 border-t border-gray-100 bg-gray-50/50 px-4 py-3">
                            <p class="min-w-0 text-sm">
                                <span class="block truncate font-semibold text-itf-dark" x-text="nomFichier"></span>
                                <span class="text-xs text-gray-500" x-text="tailleFichier"></span>
                            </p>
                            <button type="button" @click="retirer()"
                                    class="shrink-0 rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-bold text-gray-600 transition hover:border-red-300 hover:bg-red-50 hover:text-red-600">
                                Changer d'image
                            </button>
                        </div>
                    </div>

                    <input type="file" id="fichier-image" name="image" accept="image/*" required
                           x-ref="fichier" @change="charger($event.target)"
                           class="sr-only">
                </div>
            </div>

            {{-- Barre d'action --}}
            <div class="flex items-center justify-end gap-3 border-t border-gray-100 bg-gray-50/50 px-6 py-4">
                <a href="{{ route('admin.galerie.index') }}"
                   class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-100">
                    Annuler
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-itf-blue px-6 py-2.5 text-sm font-bold text-itf-white shadow-lg shadow-itf-blue/25 transition hover:-translate-y-0.5 hover:shadow-xl">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                    </svg>
                    Ajouter à la galerie
                </button>
            </div>
        </div>
    </form>

</x-admin-layout>