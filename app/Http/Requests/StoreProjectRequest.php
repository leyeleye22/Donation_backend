<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => 'required|string|unique:projects,slug',
            'theme' => 'required|string',
            'title' => 'required|array',
            'description' => 'required|array',
            'goal_amount' => 'required|integer|min:0',
            'status' => 'required|string|in:upcoming,ongoing,completed',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.required' => 'Le slug est requis.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'theme.required' => 'Le thème est requis.',
            'title.required' => 'Le titre est requis.',
            'title.array' => 'Le titre doit être un tableau.',
            'description.required' => 'La description est requise.',
            'description.array' => 'La description doit être un tableau.',
            'goal_amount.required' => 'Le montant objectif est requis.',
            'goal_amount.integer' => 'Le montant objectif doit être un entier.',
            'goal_amount.min' => 'Le montant objectif ne peut pas être négatif.',
            'status.required' => 'Le statut est requis.',
            'status.in' => 'Le statut doit être parmi : upcoming, ongoing, completed.',
        ];
    }
}
