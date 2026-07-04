<x-admin-layout title="Nouveau cours — Back-office ITF">
    <a href="{{ route('admin.cours.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour aux cours</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Nouveau cours</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-2xl">
        <form method="POST" action="{{ route('admin.cours.store') }}" enctype="multipart/form-data">
            @include('admin.cours._form')
        </form>
    </div>
</x-admin-layout>
