<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre'                      => 'required|string|max:255',
            'niveau'                     => 'required|in:L1,L2',
            'matiere'                    => 'required|string|max:255',
            'questions'                  => 'required|array|min:1',
            'questions.*.question'       => 'required|string',
            'questions.*.type'           => 'required|in:unique,multiple',
            'questions.*.choix'          => 'required|array|min:2',
            'questions.*.choix.*'        => 'required|string|max:255',
            'questions.*.bonne_reponse'  => 'nullable|string|max:255',
            'questions.*.bonnes_reponses'   => 'nullable|array',
            'questions.*.bonnes_reponses.*' => 'string|max:255',
            'questions.*.explication'       => 'nullable|string|max:2000',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            foreach ($this->input('questions', []) as $i => $question) {
                $type = $question['type'] ?? 'unique';
                $choix = array_values($question['choix'] ?? []);

                if ($type === 'unique') {
                    $bonneReponse = $question['bonne_reponse'] ?? null;
                    if (! $bonneReponse) {
                        $validator->errors()->add("questions.{$i}.bonne_reponse", 'Choisissez la bonne réponse pour la question '.($i + 1).'.');
                    } elseif (! in_array($bonneReponse, $choix, true)) {
                        $validator->errors()->add("questions.{$i}.bonne_reponse", 'La bonne réponse doit correspondre à un des choix proposés (question '.($i + 1).').');
                    }
                } else {
                    $bonnesReponses = array_values($question['bonnes_reponses'] ?? []);
                    if (empty($bonnesReponses)) {
                        $validator->errors()->add("questions.{$i}.bonnes_reponses", 'Cochez au moins une bonne réponse pour la question '.($i + 1).'.');
                    } elseif (array_diff($bonnesReponses, $choix)) {
                        $validator->errors()->add("questions.{$i}.bonnes_reponses", 'Les bonnes réponses doivent correspondre aux choix proposés (question '.($i + 1).').');
                    }
                }
            }
        });
    }
}
