<x-admin-layout title="Ajouter une photo — Back-office ITF">
    <a href="{{ route('admin.galerie.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour à la galerie</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Ajouter une photo</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-xl">
        <form method="POST" action="{{ route('admin.galerie.store') }}" enctype="multipart/form-data">
            @csrf

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
                    <input type="text" name="titre" value="{{ old('titre') }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <div>
                    <label class="block font-semibold text-itf-dark mb-1">Image</label>
                    <input type="file" name="image" accept="image/*" required
                           class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                </div>

                <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
                    Ajouter à la galerie
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
