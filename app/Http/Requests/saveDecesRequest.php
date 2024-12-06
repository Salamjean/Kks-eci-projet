<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveDecesRequest extends FormRequest
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
            'identiteDeclarant' => 'required|image|mimes:png,jpg,jpeg|max:300',
            'acteMariage' => 'image|mimes:png,jpg,jpeg|max:300',
            'deParLaLoi' => 'mimes:png,jpg,jpeg|max:300'
            ];
    }

    public function messages() 
    {
        return [
            'identiteDeclarant.required' => 'La piece du declarant est obligatoire',
            'identiteDeclarant.image' => 'Le fichier doit être une image',
            'identiteDeclarant.mimes' => 'Le format de l\'image doit être PNG, JPEG ou JPG',
            'identiteDeclarant.max' => 'La taille de l\'image ne doit pas dépasser 300KB',
            'acteMariage.image' => 'Le fichier doit être une image',
            'acteMariage.mimes' => 'Le format de l\'image doit être PNG, JPEG ou JPG',
            'acteMariage.max' => 'La taille de l\'image ne doit pas dépasser 300KB',
            'deParLaLoi.image' => 'Le fichier doit être une image',
            'deParLaLoi.mimes' => 'Le format de l\'image doit être PNG, JPEG ou JPG',
        ];
    }
}
