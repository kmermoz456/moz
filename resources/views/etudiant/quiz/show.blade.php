<x-app-layout title="{{ $quiz->titre }} — ITF" :noindex="true">

    <section class="mx-auto max-w-3xl px-4 py-10">

        {{-- Fil de retour --}}
        <a href="{{ route('etudiant.quiz.index') }}"
           class="group inline-flex items-center gap-1.5 text-sm font-semibold text-itf-blue hover:underline">
            <span class="transition group-hover:-translate-x-1">&larr;</span> Retour aux quiz
        </a>

        {{-- En-tête du quiz --}}
        <div class="mb-8 mt-3">
            <h1 class="text-2xl font-extrabold text-itf-dark sm:text-3xl">{{ $quiz->titre }}</h1>
            <div class="mt-3 flex flex-wrap items-center gap-2 text-xs font-bold">
                <span class="rounded-full bg-itf-blue/10 px-3 py-1 text-itf-blue">📖 {{ $quiz->matiere }}</span>
                <span class="rounded-full bg-itf-cream px-3 py-1 text-itf-dark">🎓 Niveau {{ $quiz->niveau }}</span>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-gray-600">
                    ❓ {{ $quiz->questions->count() }} {{ $quiz->questions->count() > 1 ? 'questions' : 'question' }}
                </span>
            </div>
        </div>

        <form method="POST" action="{{ route('etudiant.quiz.submit', $quiz) }}"
              x-data="{
                  total: {{ $quiz->questions->count() }},
                  repondues: 0,
                  compter() {
                      // Compte les questions distinctes ayant au moins une réponse cochée
                      const ids = [...new FormData(this.$el).keys()]
                          .filter(c => c.startsWith('reponses'))
                          .map(c => (c.match(/\[(\d+)\]/) || [])[1])
                          .filter(Boolean);
                      this.repondues = new Set(ids).size;
                  }
              }"
              @change="compter()">
            @csrf

            {{-- Barre de progression, collante pendant le défilement --}}
            <div class="sticky top-16 z-10 -mx-4 mb-8 border-b border-gray-100 bg-itf-white/95 px-4 py-3 backdrop-blur sm:top-[4.5rem]">
                <div class="flex items-center justify-between text-xs font-semibold">
                    <p class="text-gray-500">
                        <span class="font-extrabold text-itf-blue" x-text="repondues">0</span> / {{ $quiz->questions->count() }}
                        <span x-text="repondues > 1 ? 'questions répondues' : 'question répondue'">question répondue</span>
                    </p>
                    <p class="text-itf-blue" x-show="repondues === total" x-cloak>✓ Quiz complet !</p>
                </div>
                <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-gray-200">
                    <div class="h-full rounded-full bg-gradient-to-r from-itf-blue to-green-500 transition-all duration-500 ease-out"
                         :style="`width: ${(repondues / total) * 100}%`"></div>
                </div>
            </div>

            {{-- Questions --}}
            <div class="space-y-6">
                @foreach ($quiz->questions as $i => $question)
                    <fieldset class="rounded-2xl border border-gray-200 bg-itf-white p-6 shadow-sm">
                        <legend class="sr-only">Question {{ $i + 1 }}</legend>

                        <div class="mb-5 flex items-start gap-3">
                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl bg-itf-blue font-extrabold text-itf-white">
                                {{ $i + 1 }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="font-semibold leading-relaxed text-itf-dark">{{ $question->question }}</p>
                                @if ($question->estAChoixMultiple())
                                    <span class="mt-2 inline-block rounded-full bg-itf-cream px-2.5 py-0.5 text-xs font-bold text-itf-dark">
                                        ☑ Plusieurs réponses possibles
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2.5">
                            @foreach ($question->choix as $choix)
                                <label class="flex cursor-pointer items-center gap-3 rounded-xl border-2 border-gray-200 p-3.5 transition
                                              hover:border-itf-blue/50 hover:bg-itf-blue/5
                                              has-[:checked]:border-itf-blue has-[:checked]:bg-itf-blue/5 has-[:checked]:shadow-sm">
                                    @if ($question->estAChoixMultiple())
                                        <input type="checkbox" name="reponses[{{ $question->id }}][]" value="{{ $choix }}"
                                               class="h-4 w-4 rounded border-gray-300 text-itf-blue focus:ring-itf-blue">
                                    @else
                                        <input type="radio" name="reponses[{{ $question->id }}]" value="{{ $choix }}" required
                                               class="h-4 w-4 border-gray-300 text-itf-blue focus:ring-itf-blue">
                                    @endif
                                    <span class="text-itf-dark">{{ $choix }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                @endforeach
            </div>

            {{-- Validation --}}
            <div class="mt-8">
                <button type="submit"
                        class="group flex w-full items-center justify-center gap-2 rounded-xl bg-itf-blue py-4 font-bold text-itf-white shadow-lg shadow-itf-blue/25 transition hover:-translate-y-0.5 hover:shadow-xl">
                    Valider mes réponses
                    <svg class="h-5 w-5 transition group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
                <p class="mt-3 text-center text-xs text-gray-500"
                   x-show="repondues < total" x-cloak>
                    Il vous reste <span class="font-bold text-itf-blue" x-text="total - repondues"></span>
                    <span x-text="total - repondues > 1 ? 'questions' : 'question'"></span> avant de pouvoir valider.
                </p>
            </div>
        </form>
    </section>

</x-app-layout>