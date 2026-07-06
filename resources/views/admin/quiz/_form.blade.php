@php
    $initialQuestions = isset($quiz)
        ? $quiz->questions->map(fn ($q) => [
            'question' => $q->question,
            'type' => $q->type,
            'choix' => $q->choix,
            'bonne_reponse' => $q->bonne_reponse,
            'bonnes_reponses' => $q->bonnes_reponses ?? [],
            'explication' => $q->explication,
        ])->values()->all()
        : [['question' => '', 'type' => 'unique', 'choix' => ['', ''], 'bonne_reponse' => '', 'bonnes_reponses' => [], 'explication' => '']];
@endphp

@csrf
@if (isset($quiz))
    @method('PUT')
@endif

@if ($errors->any())
    <div class="flex gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm mb-6">
        <svg class="w-5 h-5 shrink-0 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
        </svg>
        <ul class="list-disc list-inside space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Infos générales --}}
<div class="bg-itf-white rounded-2xl border border-itf-dark/10 shadow-sm p-6 mb-6">
    <h2 class="text-sm font-bold uppercase tracking-widest text-itf-dark/50 mb-4">Informations générales</h2>
    <div class="grid sm:grid-cols-3 gap-4">
        <div>
            <label for="titre" class="block text-sm font-semibold text-itf-dark mb-1.5">Titre du quiz</label>
            <input id="titre" type="text" name="titre" value="{{ old('titre', $quiz->titre ?? '') }}" required
                   placeholder="Ex : QCM — Génétique"
                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                          placeholder-itf-dark/30 shadow-sm transition-colors duration-200
                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
        </div>
        <div>
            <label for="niveau" class="block text-sm font-semibold text-itf-dark mb-1.5">Niveau</label>
            <select id="niveau" name="niveau" required
                    class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                           shadow-sm transition-colors duration-200
                           hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
                <option value="L1" @selected(old('niveau', $quiz->niveau ?? '') === 'L1')>L1</option>
                <option value="L2" @selected(old('niveau', $quiz->niveau ?? '') === 'L2')>L2</option>
            </select>
        </div>
        <div>
            <label for="matiere" class="block text-sm font-semibold text-itf-dark mb-1.5">Matière</label>
            <input id="matiere" type="text" name="matiere" value="{{ old('matiere', $quiz->matiere ?? '') }}" required
                   placeholder="Ex : Biologie cellulaire"
                   class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                          placeholder-itf-dark/30 shadow-sm transition-colors duration-200
                          hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none">
        </div>
    </div>
</div>

<div x-data="{ questions: {{ Illuminate\Support\Js::from($initialQuestions) }} }">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-sm font-bold uppercase tracking-widest text-itf-dark/50">
            Questions <span x-text="`(${questions.length})`"></span>
        </h2>
    </div>

    <template x-for="(q, qi) in questions" :key="qi">
        <div class="relative bg-itf-white border border-itf-dark/10 rounded-2xl shadow-sm p-6 mb-4
                    transition-shadow duration-200 hover:shadow-md">

            {{-- En-tête question --}}
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2.5">
                    <span class="flex items-center justify-center w-7 h-7 rounded-full bg-itf-blue/10 text-itf-blue
                                 text-xs font-bold shrink-0" x-text="qi + 1"></span>
                    <h3 class="font-semibold text-itf-dark">Question</h3>
                </div>
                <button type="button" @click="questions.splice(qi, 1)" x-show="questions.length > 1"
                        class="inline-flex items-center gap-1 text-xs font-semibold text-red-500/80 hover:text-red-600 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                    Supprimer
                </button>
            </div>

            {{-- Intitulé --}}
            <label class="block text-sm font-semibold text-itf-dark mb-1.5">Intitulé de la question</label>
            <textarea :name="`questions[${qi}][question]`" x-model="q.question" required rows="2"
                      placeholder="Saisissez l'énoncé de la question…"
                      class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                             placeholder-itf-dark/30 shadow-sm resize-y transition-colors duration-200
                             hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none"></textarea>

            {{-- Type --}}
            <label class="block text-sm font-semibold text-itf-dark mt-5 mb-1.5">Type de question</label>
            <input type="hidden" :name="`questions[${qi}][type]`" :value="q.type">
            <div class="inline-flex rounded-xl border border-itf-dark/15 p-1 bg-itf-cream/50">
                <button type="button" @click="q.type = 'unique'; q.bonnes_reponses = []"
                        :class="q.type === 'unique' ? 'bg-itf-blue text-itf-white shadow-sm' : 'text-itf-dark/50 hover:text-itf-dark'"
                        class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-all duration-200">
                    Choix unique
                </button>
                <button type="button" @click="q.type = 'multiple'; q.bonne_reponse = ''"
                        :class="q.type === 'multiple' ? 'bg-itf-blue text-itf-white shadow-sm' : 'text-itf-dark/50 hover:text-itf-dark'"
                        class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-all duration-200">
                    Choix multiple
                </button>
            </div>

            {{-- Choix --}}
            <label class="block text-sm font-semibold text-itf-dark mt-5 mb-1.5">Choix de réponses</label>
            <div class="space-y-2">
                <template x-for="(choix, ci) in q.choix" :key="ci">
                    <div class="flex items-center gap-2.5 rounded-xl border border-itf-dark/10 bg-itf-cream/30 pl-3 pr-2 py-1.5
                                transition-colors duration-150"
                         :class="(q.type === 'unique' && q.bonne_reponse === choix && choix !== '') || (q.type === 'multiple' && q.bonnes_reponses.includes(choix) && choix !== '') ? 'border-green-300 bg-green-50/60' : ''">
                        <template x-if="q.type === 'unique'">
                            <input type="radio" :name="`questions[${qi}][bonne_reponse]`" :value="choix" x-model="q.bonne_reponse"
                                   class="shrink-0 text-itf-blue focus:ring-itf-blue focus:ring-offset-0">
                        </template>
                        <template x-if="q.type === 'multiple'">
                            <input type="checkbox" :name="`questions[${qi}][bonnes_reponses][]`" :value="choix" x-model="q.bonnes_reponses"
                                   class="shrink-0 rounded text-itf-blue focus:ring-itf-blue focus:ring-offset-0">
                        </template>
                        <input type="text" :name="`questions[${qi}][choix][${ci}]`" x-model="q.choix[ci]" required
                               placeholder="Choix de réponse"
                               class="flex-1 bg-transparent border-0 px-1 py-1 text-itf-dark placeholder-itf-dark/30
                                      focus:ring-0 focus:outline-none">
                        <button type="button" @click="q.choix.splice(ci, 1)" x-show="q.choix.length > 2"
                                class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full text-itf-dark/30
                                       hover:text-red-500 hover:bg-red-50 transition-colors duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </template>
            </div>

            <button type="button" @click="q.choix.push('')"
                    class="inline-flex items-center gap-1 text-itf-blue text-sm font-semibold mt-2.5 hover:underline">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Ajouter un choix
            </button>

            <p class="flex items-center gap-1.5 text-xs text-itf-dark/45 mt-2.5" x-show="q.type === 'unique'">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                </svg>
                Cochez le bouton radio du choix qui est la bonne réponse.
            </p>
            <p class="flex items-center gap-1.5 text-xs text-itf-dark/45 mt-2.5" x-show="q.type === 'multiple'">
                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                </svg>
                Cochez toutes les bonnes réponses (plusieurs possibles).
            </p>

            {{-- Explication --}}
            <label class="block text-sm font-semibold text-itf-dark mt-5 mb-1.5">
                Explication <span class="font-normal text-itf-dark/40">(facultatif)</span>
            </label>
            <textarea :name="`questions[${qi}][explication]`" x-model="q.explication" rows="2"
                      placeholder="Affichée à l'étudiant après sa réponse, pour l'aider à comprendre la correction."
                      class="w-full rounded-xl border border-itf-dark/15 bg-itf-white px-4 py-2.5 text-itf-dark
                             placeholder-itf-dark/30 shadow-sm resize-y transition-colors duration-200
                             hover:border-itf-blue/40 focus:border-itf-blue focus:ring-2 focus:ring-itf-blue/20 focus:outline-none"></textarea>
        </div>
    </template>

    <button type="button" @click="questions.push({ question: '', type: 'unique', choix: ['', ''], bonne_reponse: '', bonnes_reponses: [], explication: '' })"
            class="inline-flex items-center gap-2 w-full justify-center border-2 border-dashed border-itf-blue/30 text-itf-blue
                   font-semibold py-3 rounded-xl mb-6 transition-colors duration-200 hover:bg-itf-blue/5 hover:border-itf-blue/50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Ajouter une question
    </button>

    <div>
        <button type="submit"
                class="inline-flex items-center gap-2 bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-xl
                       shadow-md shadow-itf-blue/25 transition-all duration-300
                       hover:shadow-lg hover:shadow-itf-blue/35 hover:-translate-y-0.5 active:translate-y-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            {{ isset($quiz) ? 'Mettre à jour le quiz' : 'Créer le quiz' }}
        </button>
    </div>
</div>