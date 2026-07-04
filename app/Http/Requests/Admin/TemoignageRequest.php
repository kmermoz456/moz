<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TemoignageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'       => 'required|string|max:255',
            'promotion' => 'nullable|string|max:255',
            'contenu'   => 'required|string',
            'photo'     => 'nullable|image|max:4096',
            'publie'    => 'nullable|boolean',
        ];
    }
}
