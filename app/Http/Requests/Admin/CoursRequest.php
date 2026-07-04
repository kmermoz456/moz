<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CoursRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'niveau'      => 'required|in:L1,L2',
            'matiere'     => 'required|string|max:255',
            'gratuit'     => 'nullable|boolean',
            'fichier_pdf' => ($this->isMethod('post') ? 'required' : 'nullable').'|file|mimes:pdf|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'fichier_pdf.required' => 'Le fichier PDF du cours est obligatoire.',
            'fichier_pdf.mimes'    => 'Le fichier doit être un PDF.',
            'fichier_pdf.max'      => 'Le PDF ne doit pas dépasser 20 Mo.',
        ];
    }
}
