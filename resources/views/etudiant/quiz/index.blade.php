<x-app-layout title="Quiz — Mon espace ITF" :noindex="true">
    <section class="max-w-6xl mx-auto px-4 py-10">

        {{-- En-tête --}}
        <div class="flex flex-wrap items-center gap-3 mb-8">
            <h1 class="text-2xl font-bold text-itf-dark">Quiz</h1>
            <span class="inline-flex items-center rounded-full bg-itf-blue/10 text-itf-blue text-sm font-semibold px-3 py-1">
                Niveau {{ auth()->user()->niveau }}
            </span>
        </div>

        {{-- Liste des quiz par matière --}}
        @forelse ($quiz as $matiere => $quizMatiere)
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-4">
                    <h3 class="font-semibold text-itf-dark">{{ $matiere }}</h3>
                    <span class="text-xs font-medium text-gray-400">{{ count($quizMatiere) }} quiz</span>
                    <span class="flex-1 h-px bg-gray-100"></span>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($quizMatiere as $item)
                        <div class="group flex flex-col rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:shadow-md hover:-translate-y-0.5">
                            <div class="flex items-center justify-center h-11 w-11 rounded-xl bg-itf-blue/10 text-itf-blue mb-4">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                                </svg>
                            </div>

                            <h4 class="font-bold text-itf-dark">{{ $item->titre }}</h4>
                            <p class="flex items-center gap-1.5 text-sm text-gray-500 mt-1">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M12 17.25h.007v.008H12v-.008ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                {{ $item->questions_count }} question(s)
                            </p>

                            <a href="{{ route('etudiant.quiz.show', $item) }}"
                               class="mt-5 inline-flex items-center justify-center gap-1.5 bg-itf-blue text-itf-white text-sm font-semibold px-4 py-2.5 rounded-lg hover:opacity-90 transition">
                                Commencer
                                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 px-6 py-12 text-center mb-10">
                <p class="text-gray-500">Aucun quiz disponible pour le moment pour votre niveau.</p>
                <p class="text-sm text-gray-400 mt-1">Revenez bientôt, de nouveaux quiz sont ajoutés régulièrement.</p>
            </div>
        @endforelse

        {{-- Historique des scores --}}
        <h2 class="text-xl font-bold text-itf-dark mt-12 mb-4">Historique de mes scores</h2>

        @if ($historique->count())
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-itf-cream/70 text-itf-dark">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Quiz</th>
                                <th class="px-4 py-3 font-semibold">Score</th>
                                <th class="px-4 py-3 font-semibold text-right">Date</th>
                                <th class="px-4 py-3 font-semibold text-right">Correction</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($historique as $attempt)
                                @php
                                    $ratio = $attempt->total > 0 ? $attempt->score / $attempt->total : 0;
                                    $scoreClass = $ratio >= 0.7
                                        ? 'bg-emerald-50 text-emerald-700'
                                        : ($ratio >= 0.4 ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700');
                                @endphp
                                <tr class="hover:bg-gray-50/70 transition-colors">
                                    <td class="px-4 py-3 font-medium text-itf-dark">{{ $attempt->quiz->titre ?? '—' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $scoreClass }}">
                                            {{ $attempt->score }}/{{ $attempt->total }}
                                            <span class="ml-1 opacity-70">({{ round($ratio * 100) }}%)</span>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-500 text-right whitespace-nowrap">{{ $attempt->created_at->translatedFormat('d F Y à H:i') }}</td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        @if ($attempt->reponses !== null)
                                            <a href="{{ route('etudiant.quiz.resultats', $attempt) }}" class="font-semibold text-itf-blue hover:underline">Voir</a>
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 px-6 py-10 text-center">
                <p class="text-gray-500">Vous n'avez pas encore fait de quiz.</p>
                <p class="text-sm text-gray-400 mt-1">Choisissez un quiz ci-dessus pour démarrer.</p>
            </div>
        @endif
    </section>
</x-app-layout>