<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProspectRequest extends FormRequest
{
    protected $errorBag = 'prospect';

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'         => 'required|string|max:150',
            'telephone'   => 'required|string|max:20',
            'page_source' => 'nullable|string|max:100',
        ];
    }
}
