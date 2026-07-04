<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ParametresRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'taux_reussite'      => 'required|integer|min:0|max:100',
            'taux_satisfaction'  => 'required|integer|min:0|max:100',
            'nombre_enseignants' => 'required|integer|min:0',
            'annees_experience'  => 'required|integer|min:0',
            'whatsapp_lien'      => 'required|url',
            'places_disponibles' => 'required|integer|min:0',
        ];
    }
}
