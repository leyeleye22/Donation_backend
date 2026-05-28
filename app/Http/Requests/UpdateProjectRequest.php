<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => 'sometimes|string|unique:projects,slug,' . $this->route('project'),
            'theme' => 'sometimes|string',
            'title' => 'sometimes|array',
            'description' => 'sometimes|array',
            'goal_amount' => 'sometimes|integer|min:0',
            'status' => 'sometimes|string|in:upcoming,ongoing,completed',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'theme.string' => 'Le thème doit être une chaîne de caractères.',
            'title.array' => 'Le titre doit être un tableau.',
            'description.array' => 'La description doit être un tableau.',
            'goal_amount.integer' => 'Le montant objectif doit être un entier.',
            'goal_amount.min' => 'Le montant objectif ne peut pas être négatif.',
            'status.in' => 'Le statut doit être parmi : upcoming, ongoing, completed.',
        ];
    }
}
