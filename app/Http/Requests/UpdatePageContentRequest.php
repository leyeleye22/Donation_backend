<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Le contenu est requis.',
            'content.array' => 'Le contenu doit être un tableau.',
        ];
    }
}
