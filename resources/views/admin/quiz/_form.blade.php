@php
    $initialQuestions = isset($quiz)
        ? $quiz->questions->map(fn ($q) => [
            'question' => $q->question,
            'type' => $q->type,
            'choix' => $q->choix,
            'bonne_reponse' => $q->bonne_reponse,
            'bonnes_reponses' => $q->bonnes_reponses ?? [],
        ])->values()->all()
        : [['question' => '', 'type' => 'unique', 'choix' => ['', ''], 'bonne_reponse' => '', 'bonnes_reponses' => []]];
@endphp

@csrf
@if (isset($quiz))
    @method('PUT')
@endif

@if ($errors->any())
    <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-4 text-sm mb-4">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-5 mb-8">
    <div class="grid sm:grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Titre du quiz</label>
            <input type="text" name="titre" value="{{ old('titre', $quiz->titre ?? '') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
        </div>
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Niveau</label>
            <select name="niveau" required class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                <option value="L1" @selected(old('niveau', $quiz->niveau ?? '') === 'L1')>L1</option>
                <option value="L2" @selected(old('niveau', $quiz->niveau ?? '') === 'L2')>L2</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold text-itf-dark mb-1">Matière</label>
            <input type="text" name="matiere" value="{{ old('matiere', $quiz->matiere ?? '') }}" required
                   class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
        </div>
    </div>
</div>

<div x-data="{ questions: {{ Illuminate\Support\Js::from($initialQuestions) }} }">
    <template x-for="(q, qi) in questions" :key="qi">
        <div class="border border-gray-200 rounded-xl p-5 mb-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-semibold text-itf-dark">Question <span x-text="qi + 1"></span></h3>
                <button type="button" @click="questions.splice(qi, 1)" x-show="questions.length > 1"
                        class="text-red-600 text-sm hover:underline">Supprimer</button>
            </div>

            <label class="block text-sm font-semibold text-itf-dark mb-1">Intitulé de la question</label>
            <textarea :name="`questions[${qi}][question]`" x-model="q.question" required rows="2"
                      class="w-full rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue"></textarea>

            <label class="block text-sm font-semibold text-itf-dark mt-4 mb-1">Type de question</label>
            <input type="hidden" :name="`questions[${qi}][type]`" :value="q.type">
            <div class="flex gap-2">
                <button type="button" @click="q.type = 'unique'; q.bonnes_reponses = []"
                        :class="q.type === 'unique' ? 'bg-itf-blue text-itf-white' : 'bg-gray-100 text-gray-600'"
                        class="px-4 py-1.5 rounded-lg text-sm font-semibold transition">Choix unique</button>
                <button type="button" @click="q.type = 'multiple'; q.bonne_reponse = ''"
                        :class="q.type === 'multiple' ? 'bg-itf-blue text-itf-white' : 'bg-gray-100 text-gray-600'"
                        class="px-4 py-1.5 rounded-lg text-sm font-semibold transition">Choix multiple</button>
            </div>

            <label class="block text-sm font-semibold text-itf-dark mt-4 mb-1">Choix de réponses</label>
            <div class="space-y-2">
                <template x-for="(choix, ci) in q.choix" :key="ci">
                    <div class="flex items-center gap-2">
                        <template x-if="q.type === 'unique'">
                            <input type="radio" :name="`questions[${qi}][bonne_reponse]`" :value="choix" x-model="q.bonne_reponse"
                                   class="text-itf-blue focus:ring-itf-blue">
                        </template>
                        <template x-if="q.type === 'multiple'">
                            <input type="checkbox" :name="`questions[${qi}][bonnes_reponses][]`" :value="choix" x-model="q.bonnes_reponses"
                                   class="rounded text-itf-blue focus:ring-itf-blue">
                        </template>
                        <input type="text" :name="`questions[${qi}][choix][${ci}]`" x-model="q.choix[ci]" required
                               placeholder="Choix de réponse"
                               class="flex-1 rounded-lg border-gray-300 focus:border-itf-blue focus:ring-itf-blue">
                        <button type="button" @click="q.choix.splice(ci, 1)" x-show="q.choix.length > 2"
                                class="text-red-600 text-sm">&times;</button>
                    </div>
                </template>
            </div>
            <button type="button" @click="q.choix.push('')" class="text-itf-blue text-sm font-semibold mt-2 hover:underline">
                + Ajouter un choix
            </button>
            <p class="text-xs text-gray-500 mt-2" x-show="q.type === 'unique'">Cochez le bouton radio du choix qui est la bonne réponse.</p>
            <p class="text-xs text-gray-500 mt-2" x-show="q.type === 'multiple'">Cochez toutes les bonnes réponses (plusieurs possibles).</p>
        </div>
    </template>

    <button type="button" @click="questions.push({ question: '', type: 'unique', choix: ['', ''], bonne_reponse: '', bonnes_reponses: [] })"
            class="text-itf-blue font-semibold hover:underline mb-6">
        + Ajouter une question
    </button>

    <div>
        <button type="submit" class="bg-itf-blue text-itf-white font-bold px-6 py-3 rounded-lg hover:opacity-90 transition">
            {{ isset($quiz) ? 'Mettre à jour le quiz' : 'Créer le quiz' }}
        </button>
    </div>
</div>
