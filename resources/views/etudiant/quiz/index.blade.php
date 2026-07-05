<x-app-layout title="Quiz — Mon espace ITF" :noindex="true">
    <section class="max-w-6xl mx-auto px-4 py-10">
        <h1 class="text-2xl font-bold text-itf-dark mb-6">Quiz — Niveau {{ auth()->user()->niveau }}</h1>

        @forelse ($quiz as $matiere => $quizMatiere)
            <div class="mb-8">
                <h3 class="font-semibold text-itf-blue mb-3">{{ $matiere }}</h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($quizMatiere as $item)
                        <div class="border border-gray-200 rounded-xl p-5">
                            <h4 class="font-bold text-itf-dark">{{ $item->titre }}</h4>
                            <p class="text-sm text-gray-500 mt-1">{{ $item->questions_count }} question(s)</p>
                            <a href="{{ route('etudiant.quiz.show', $item) }}"
                               class="inline-block mt-4 bg-itf-blue text-itf-white text-sm font-semibold px-4 py-2 rounded-lg hover:opacity-90 transition">
                                Commencer
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-gray-500 mb-8">Aucun quiz disponible pour le moment pour votre niveau.</p>
        @endforelse

        {{-- Historique des scores --}}
        <h2 class="text-xl font-bold text-itf-dark mt-10 mb-4">Historique de mes scores</h2>
        @if ($historique->count())
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-itf-cream text-itf-dark">
                        <tr>
                            <th class="p-3">Quiz</th>
                            <th class="p-3">Score</th>
                            <th class="p-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historique as $attempt)
                            <tr class="border-t border-gray-100">
                                <td class="p-3">{{ $attempt->quiz->titre ?? '—' }}</td>
                                <td class="p-3 font-semibold">{{ $attempt->score }}/{{ $attempt->total }}</td>
                                <td class="p-3 text-gray-500">{{ $attempt->created_at->translatedFormat('d F Y à H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Vous n'avez pas encore fait de quiz.</p>
        @endif
    </section>
</x-app-layout>
