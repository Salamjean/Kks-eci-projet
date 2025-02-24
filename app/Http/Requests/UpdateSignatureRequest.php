<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSignatureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
        ];
    }

    public function messages()
    {
        return [
            'signature.image' => 'Le fichier doit être une image.',
            'signature.mimes' => 'Les types d\'image autorisés sont : jpeg, png, jpg, gif, svg.',
            'signature.max' => 'La taille maximale de l\'image est de 2 Mo.',
        ];
    }
}