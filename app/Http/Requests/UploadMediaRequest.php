<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi,pdf,doc,docx|max:102400',
            'title' => 'sometimes|array',
            'categories' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Le fichier est requis.',
            'file.file' => 'Veuillez fournir un fichier valide.',
            'file.mimes' => 'Le fichier doit être de type : jpeg, png, jpg, gif, webp, mp4, mov, avi, pdf, doc, docx.',
            'file.max' => 'Le fichier ne doit pas dépasser 100 Mo.',
            'title.array' => 'Le titre doit être un tableau.',
        ];
    }
}
