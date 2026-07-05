<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommanderDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantite' => 'required|integer|min:1|max:20',
            'notes'    => 'nullable|string|max:500',
        ];
    }
}
