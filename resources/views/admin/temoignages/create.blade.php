<x-admin-layout title="Nouveau témoignage — Back-office ITF">
    <a href="{{ route('admin.temoignages.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour aux témoignages</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Nouveau témoignage</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-2xl">
        <form method="POST" action="{{ route('admin.temoignages.store') }}" enctype="multipart/form-data">
            @include('admin.temoignages._form')
        </form>
    </div>
</x-admin-layout>
