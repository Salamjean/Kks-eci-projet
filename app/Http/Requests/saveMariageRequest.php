<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveMariageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pieceIdentite' => 'required|image|mimes:png,jpg,jpeg|max:300',
            'extraitMariage' => 'required|image|mimes:png,jpg,jpeg|max:300',
            ];
    }

    public function messages() 
    {
        return [
            'pieceIdentite.required' => 'Le champ est obligatoire.',
            'extraitMariage.required' => 'Le champ est obligatoire.',
            'pieceIdentite.image' => 'Le champ doit être une image.',
            'pieceIdentite.mimes' => 'Le format de l\'image doit être PNG, JPG ou JPEG.',
            'pieceIdentite.max' => 'La taille de l\'image ne doit pas dépasser 300Ko.',
            'extraitMariage.image' => 'Le champ doit être une image.',
            'extraitMariage.mimes' => 'Le format de l\'image doit être PNG, JPG ou JPEG.',
            'extraitMariage.max' => 'La taille de l\'image ne doit pas dépasser 300Ko.',
            
        ];
    }
}
