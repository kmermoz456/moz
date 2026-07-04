<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaiementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'montant' => 'required|integer|min:0',
            'mois'    => 'required|string|max:50',
            'statut'  => 'required|in:en_attente,valide',
        ];
    }
}
