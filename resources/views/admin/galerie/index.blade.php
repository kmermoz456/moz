<x-admin-layout title="Galerie — Back-office ITF">

    {{-- En-tête de page --}}
    <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="flex items-center gap-3 text-2xl font-extrabold text-itf-dark">
                Galerie
                <span class="rounded-full bg-itf-blue/10 px-3 py-1 text-sm font-bold text-itf-blue">
                    {{ $photos->total() }} {{ $photos->total() > 1 ? 'photos' : 'photo' }}
                </span>
            </h1>
            <p class="mt-1 text-sm text-gray-500">Ces photos alimentent la galerie de la page d'accueil.</p>
        </div>
        <a href="{{ route('admin.galerie.create') }}"
           class="inline-flex items-center gap-2 rounded-xl bg-itf-blue px-5 py-2.5 font-bold text-itf-white shadow-lg shadow-itf-blue/25 transition hover:-translate-y-0.5 hover:shadow-xl">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
            </svg>
            Ajouter une photo
        </a>
    </div>

    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        @forelse ($photos as $photo)
            <figure class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                {{-- Image avec zoom au survol --}}
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('storage/'.$photo->image) }}" alt="{{ $photo->titre }}"
                         loading="lazy"
                         class="h-full w-full object-cover transition duration-500 group-hover:scale-105">

                    {{-- Bouton supprimer, révélé au survol (toujours visible au clavier / tactile) --}}
                    <form method="POST" action="{{ route('admin.galerie.destroy', $photo) }}"
                          onsubmit="return confirm('Supprimer cette photo ? Cette action est définitive.');"
                          class="absolute right-2 top-2 opacity-100 transition sm:opacity-0 sm:group-hover:opacity-100 sm:group-focus-within:opacity-100">
                        @csrf
                        @method('DELETE')
                        <button type="submit" aria-label="Supprimer « {{ $photo->titre }} »"
                                class="grid h-9 w-9 place-items-center rounded-full bg-white/95 text-red-600 shadow-md transition hover:bg-red-600 hover:text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25v6m4-6v6M3.375 7.5h17.25M9.75 7.5V5.25c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V7.5"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Titre + date --}}
                <figcaption class="p-3">
                    <p class="truncate text-sm font-semibold text-itf-dark" title="{{ $photo->titre }}">{{ $photo->titre }}</p>
                    @if ($photo->created_at)
                        <p class="mt-0.5 text-xs text-gray-400">Ajoutée le {{ $photo->created_at->translatedFormat('d M Y') }}</p>
                    @endif
                    @if (auth()->user()->estSuperAdmin())
                        <p class="mt-0.5 text-xs text-gray-400">Par {{ $photo->creePar->name ?? '—' }}</p>
                    @endif
                </figcaption>
            </figure>
        @empty
            {{-- État vide --}}
            <div class="col-span-full rounded-2xl border-2 border-dashed border-gray-200 bg-gray-50/50 p-12 text-center">
                <span class="text-5xl">🖼️</span>
                <p class="mt-4 font-bold text-itf-dark">Aucune photo dans la galerie</p>
                <p class="mx-auto mt-1 max-w-sm text-sm text-gray-500">
                    Ajoutez des photos de vos séances de cours et de vos étudiants :
                    la preuve visuelle rassure les nouveaux bacheliers.
                </p>
                <a href="{{ route('admin.galerie.create') }}"
                   class="mt-5 inline-flex items-center gap-2 rounded-xl bg-itf-blue px-5 py-2.5 text-sm font-bold text-itf-white transition hover:opacity-90">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"/>
                    </svg>
                    Ajouter la première photo
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $photos->links() }}</div>

</x-admin-layout>