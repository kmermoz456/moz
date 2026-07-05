<x-admin-layout title="Modifier un document — Back-office ITF">
    <a href="{{ route('admin.documents.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour au catalogue</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Modifier « {{ $document->titre }} »</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-2xl">
        <form method="POST" action="{{ route('admin.documents.update', $document) }}" enctype="multipart/form-data">
            @include('admin.documents._form')
        </form>
    </div>
</x-admin-layout>
