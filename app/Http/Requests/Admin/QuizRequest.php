<?php

namespace App\Http\Requests\Admin;

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
            'questions.*.choix'          => 'required|array|min:2',
            'questions.*.choix.*'        => 'required|string|max:255',
            'questions.*.bonne_reponse'  => 'required|string|max:255',
        ];
    }
}
