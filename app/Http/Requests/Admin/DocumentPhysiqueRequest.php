<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DocumentPhysiqueRequest extends FormRequest
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
            'categorie'   => 'required|string|max:255',
            'niveau'      => 'required|in:L1,L2,Tous',
            'prix'        => 'required|integer|min:0',
            'image'       => 'nullable|image|max:4096',
            'disponible'  => 'nullable|boolean',
        ];
    }
}
