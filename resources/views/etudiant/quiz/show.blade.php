<x-app-layout>
    <section class="max-w-3xl mx-auto px-4 py-10">
        <a href="{{ route('etudiant.quiz.index') }}" class="text-sm text-itf-blue hover:underline">&larr; Retour aux quiz</a>
        <h1 class="text-2xl font-bold text-itf-dark mt-2 mb-1">{{ $quiz->titre }}</h1>
        <p class="text-gray-500 mb-8">{{ $quiz->matiere }} — Niveau {{ $quiz->niveau }}</p>

        <form method="POST" action="{{ route('etudiant.quiz.submit', $quiz) }}"
              x-data="{ total: {{ $quiz->questions->count() }}, repondues: 0 }"
              @change="repondues = Object.keys(Object.fromEntries(new FormData($el).entries()).reponses || {}).length">
            @csrf

            {{-- Barre de progression --}}
            <div class="mb-8">
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-itf-blue transition-all" :style="`width: ${(repondues / total) * 100}%`"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1"><span x-text="repondues"></span> / {{ $quiz->questions->count() }} question(s) répondue(s)</p>
            </div>

            <div class="space-y-6">
                @foreach ($quiz->questions as $i => $question)
                    <div class="border border-gray-200 rounded-xl p-6">
                        <p class="font-semibold text-itf-dark mb-4">{{ $i + 1 }}. {{ $question->question }}</p>
                        <div class="space-y-2">
                            @foreach ($question->choix as $choix)
                                <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-itf-blue">
                                    <input type="radio" name="reponses[{{ $question->id }}]" value="{{ $choix }}" required
                                           class="text-itf-blue focus:ring-itf-blue">
                                    <span>{{ $choix }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit"
                    class="w-full mt-8 bg-itf-blue text-itf-white font-bold py-4 rounded-lg hover:opacity-90 transition">
                Valider mes réponses
            </button>
        </form>
    </section>
</x-app-layout>
