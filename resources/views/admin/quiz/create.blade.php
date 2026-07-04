<x-admin-layout title="Nouveau quiz — Back-office ITF">
    <a href="{{ route('admin.quiz.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour aux quiz</a>
    <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-6">Nouveau quiz</h1>

    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 max-w-3xl">
        <form method="POST" action="{{ route('admin.quiz.store') }}">
            @include('admin.quiz._form')
        </form>
    </div>
</x-admin-layout>
