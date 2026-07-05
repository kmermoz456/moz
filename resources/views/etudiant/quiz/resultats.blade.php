<x-app-layout title="Résultats — {{ $attempt->quiz->titre }} — ITF" :noindex="true">

    @php
        $ratio = $attempt->total > 0 ? $attempt->score / $attempt->total : 0;
        $pourcentage = round($ratio * 100);
        $couleur = $ratio >= 0.7 ? 'green' : ($ratio >= 0.4 ? 'amber' : 'red');
        $message = $ratio >= 0.7
            ? 'Excellent travail, continuez ainsi ! 🎉'
            : ($ratio >= 0.4 ? 'Pas mal, encore un peu de révision et ce sera parfait. 💪' : 'Ne vous découragez pas, revoyez les explications ci-dessous. 📚');
    @endphp

    {{-- ================= En-tête : score ================= --}}
    <section class="relative overflow-hidden bg-itf-blue text-itf-white">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-itf-cream/10 blur-3xl"></div>
        </div>

        <div class="relative mx-auto max-w-3xl px-4 py-12 text-center">
            <p class="text-xs font-bold uppercase tracking-widest text-itf-cream/80">Résultats du quiz</p>
            <h1 class="mt-1 text-2xl font-extrabold sm:text-3xl">{{ $attempt->quiz->titre }}</h1>

            <div class="mx-auto mt-6 grid h-32 w-32 place-items-center rounded-full bg-itf-white/10 backdrop-blur">
                <div>
                    <p class="text-3xl font-extrabold">{{ $attempt->score }}/{{ $attempt->total }}</p>
                    <p class="text-xs font-bold text-itf-cream/90">{{ $pourcentage }}%</p>
                </div>
            </div>

            <p class="mx-auto mt-5 max-w-md text-itf-cream/90">{{ $message }}</p>
        </div>
    </section>

    <section class="mx-auto max-w-3xl px-4 py-10">

        {{-- ================= Correction détaillée ================= --}}
        <div class="space-y-6">
            @foreach ($attempt->quiz->questions as $i => $question)
                @php
                    $reponseEtudiant = $attempt->reponses[$question->id] ?? null;
                    $bonnesReponsesListe = $question->estAChoixMultiple() ? ($question->bonnes_reponses ?? []) : [$question->bonne_reponse];
                    $reponsesSelectionnees = $question->estAChoixMultiple()
                        ? array_values((array) $reponseEtudiant)
                        : ($reponseEtudiant !== null ? [$reponseEtudiant] : []);
                    $estCorrecte = $question->estCorrecte($reponseEtudiant);
                @endphp

                <div class="rounded-2xl border-2 bg-itf-white p-6 shadow-sm {{ $estCorrecte ? 'border-green-200' : 'border-red-200' }}">
                    <div class="mb-4 flex items-start gap-3">
                        <span class="grid h-9 w-9 shrink-0 place-items-center rounded-xl font-extrabold text-itf-white {{ $estCorrecte ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $estCorrecte ? '✓' : '✗' }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold leading-relaxed text-itf-dark">{{ $i + 1 }}. {{ $question->question }}</p>
                            <span class="mt-1 inline-block rounded-full px-2.5 py-0.5 text-xs font-bold {{ $estCorrecte ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $estCorrecte ? 'Bonne réponse' : 'Réponse incorrecte' }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        @foreach ($question->choix as $choix)
                            @php
                                $estBonneReponse = in_array($choix, $bonnesReponsesListe, true);
                                $etaitSelectionnee = in_array($choix, $reponsesSelectionnees, true);
                            @endphp
                            <div class="flex items-center gap-3 rounded-xl border-2 p-3
                                {{ $estBonneReponse ? 'border-green-300 bg-green-50' : ($etaitSelectionnee ? 'border-red-300 bg-red-50' : 'border-gray-200') }}">
                                <span class="w-4 shrink-0 text-center font-bold {{ $estBonneReponse ? 'text-green-600' : ($etaitSelectionnee ? 'text-red-600' : 'text-transparent') }}">
                                    {{ $estBonneReponse ? '✓' : ($etaitSelectionnee ? '✗' : '·') }}
                                </span>
                                <span class="flex-1 text-itf-dark">{{ $choix }}</span>
                                @if ($etaitSelectionnee)
                                    <span class="shrink-0 text-xs font-semibold text-gray-500">Votre choix</span>
                                @endif
                            </div>
                        @endforeach

                        @if (empty($reponsesSelectionnees))
                            <p class="text-xs italic text-gray-400">Vous n'avez pas répondu à cette question.</p>
                        @endif
                    </div>

                    @if ($question->explication)
                        <div class="mt-4 flex gap-3 rounded-xl bg-itf-cream p-4 text-sm text-itf-dark">
                            <span class="shrink-0">💡</span>
                            <p><strong>Explication :</strong> {{ $question->explication }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- ================= Actions ================= --}}
        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('etudiant.quiz.show', $attempt->quiz) }}"
               class="flex-1 rounded-xl border-2 border-itf-blue/30 px-6 py-3 text-center font-bold text-itf-blue transition hover:border-itf-blue hover:bg-itf-blue/5">
                Refaire ce quiz
            </a>
            <a href="{{ route('etudiant.quiz.index') }}"
               class="flex-1 rounded-xl bg-itf-blue px-6 py-3 text-center font-bold text-itf-white transition hover:opacity-90">
                Retour aux quiz
            </a>
        </div>
    </section>

</x-app-layout>
