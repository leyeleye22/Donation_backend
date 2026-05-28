<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => 'required|string|unique:posts,slug',
            'title' => 'required|array',
            'excerpt' => 'required|array',
            'content' => 'required|array',
            'category' => 'required|string',
            'image' => 'sometimes|string',
            'is_published' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.required' => 'Le slug est requis.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'title.required' => 'Le titre est requis.',
            'title.array' => 'Le titre doit être un tableau.',
            'excerpt.required' => 'L\'extrait est requis.',
            'excerpt.array' => 'L\'extrait doit être un tableau.',
            'content.required' => 'Le contenu est requis.',
            'content.array' => 'Le contenu doit être un tableau.',
            'category.required' => 'La catégorie est requise.',
            'image.string' => 'L\'image doit être une chaîne de caractères.',
            'is_published.boolean' => 'Le champ publié doit être un booléen.',
        ];
    }
}
