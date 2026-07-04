<x-admin-layout title="Galerie — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Galerie</h1>
        <a href="{{ route('admin.galerie.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Ajouter une photo
        </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        @forelse ($photos as $photo)
            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100">
                <img src="{{ asset('storage/'.$photo->image) }}" alt="{{ $photo->titre }}" class="w-full h-32 object-cover">
                <div class="p-3">
                    <p class="text-sm font-semibold text-itf-dark truncate">{{ $photo->titre }}</p>
                    <form method="POST" action="{{ route('admin.galerie.destroy', $photo) }}" class="mt-2"
                          onsubmit="return confirm('Supprimer cette photo ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 text-xs hover:underline">Supprimer</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">Aucune photo dans la galerie.</p>
        @endforelse
    </div>

    <div class="mt-6">{{ $photos->links() }}</div>
</x-admin-layout>
