<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ActualiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre'   => 'required|string|max:255',
            'contenu' => 'required|string',
            'image'   => 'nullable|image|max:4096',
            'publie'  => 'nullable|boolean',
        ];
    }
}
