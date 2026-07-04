<x-admin-layout title="Modifier l'actualité — Back-office ITF">
    <a href="{{ route('admin.actualites.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour aux actualités</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Modifier l'actualité</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-2xl">
        <form method="POST" action="{{ route('admin.actualites.update', $actualite) }}" enctype="multipart/form-data">
            @include('admin.actualites._form')
        </form>
    </div>
</x-admin-layout>
