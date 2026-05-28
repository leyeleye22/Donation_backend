<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => 'sometimes|string',
            'donation_cta_text' => 'sometimes|string',
            'show_floating_button' => 'sometimes|boolean',
            'meta_title' => 'sometimes|string',
            'meta_description' => 'sometimes|string',
            'about_text' => 'sometimes|string',
            'email_contact' => 'sometimes|email',
            'phone_contact' => 'sometimes|string',
            'address' => 'sometimes|string',
            'social_links' => 'sometimes|array',
            'primary_color' => 'sometimes|string',
            'secondary_color' => 'sometimes|string',
            'favicon_url' => 'sometimes|string',
            'logo_url' => 'sometimes|string',
            'footer_text' => 'sometimes|string',
            'locale' => 'sometimes|string',
            'currency' => 'sometimes|string',
        ];
    }

    public function messages(): array
    {
        return [
            'site_name.string' => 'Le nom du site doit être une chaîne de caractères.',
            'donation_cta_text.string' => 'Le texte du bouton de don doit être une chaîne de caractères.',
            'show_floating_button.boolean' => 'Le champ bouton flottant doit être un booléen.',
            'email_contact.email' => 'L\'email de contact doit être une adresse valide.',
            'social_links.array' => 'Les liens sociaux doivent être un tableau.',
        ];
    }
}
