<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => 'sometimes|string|unique:posts,slug,' . $this->route('post'),
            'title' => 'sometimes|array',
            'excerpt' => 'sometimes|array',
            'content' => 'sometimes|array',
            'category' => 'sometimes|string',
            'image' => 'sometimes|string',
            'is_published' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'title.array' => 'Le titre doit être un tableau.',
            'excerpt.array' => 'L\'extrait doit être un tableau.',
            'content.array' => 'Le contenu doit être un tableau.',
            'category.string' => 'La catégorie doit être une chaîne de caractères.',
            'image.string' => 'L\'image doit être une chaîne de caractères.',
            'is_published.boolean' => 'Le champ publié doit être un booléen.',
        ];
    }
}
