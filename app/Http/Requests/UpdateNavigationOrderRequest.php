<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNavigationOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array',
            'items.*.id' => 'required|string|exists:nav_items,id',
            'items.*.sort_order' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Les éléments de navigation sont requis.',
            'items.array' => 'Les éléments doivent être un tableau.',
            'items.*.id.required' => 'L\'identifiant de l\'élément est requis.',
            'items.*.id.exists' => 'L\'élément de navigation spécifié n\'existe pas.',
            'items.*.sort_order.required' => 'L\'ordre de tri est requis.',
            'items.*.sort_order.integer' => 'L\'ordre de tri doit être un entier.',
        ];
    }
}
