<x-admin-layout title="Quiz — Back-office ITF">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-itf-dark">Quiz</h1>
        <a href="{{ route('admin.quiz.create') }}" class="bg-itf-blue text-itf-white font-semibold px-5 py-2 rounded-lg hover:opacity-90">
            + Nouveau quiz
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-itf-cream text-itf-dark">
                <tr>
                    <th class="p-3">Titre</th>
                    <th class="p-3">Matière</th>
                    <th class="p-3">Niveau</th>
                    <th class="p-3">Questions</th>
                    @if (auth()->user()->estSuperAdmin())
                        <th class="p-3">Créé par</th>
                    @endif
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quiz as $item)
                    <tr class="border-t border-gray-100">
                        <td class="p-3">{{ $item->titre }}</td>
                        <td class="p-3">{{ $item->matiere }}</td>
                        <td class="p-3">{{ $item->niveau }}</td>
                        <td class="p-3">{{ $item->questions_count }}</td>
                        @if (auth()->user()->estSuperAdmin())
                            <td class="p-3 text-gray-500">{{ $item->creePar->name ?? '—' }}</td>
                        @endif
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.quiz.edit', $item) }}" class="text-itf-blue hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.quiz.destroy', $item) }}" class="inline"
                                  onsubmit="return confirm('Supprimer ce quiz ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ auth()->user()->estSuperAdmin() ? 6 : 5 }}" class="p-3 text-gray-500">Aucun quiz pour le moment.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $quiz->links() }}</div>
</x-admin-layout>
