<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisibilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page_visibility' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'page_visibility.required' => 'La visibilité des pages est requise.',
            'page_visibility.array' => 'La visibilité des pages doit être un tableau.',
        ];
    }
}
