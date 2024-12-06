<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveNaissanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
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
            
        ];
    }

    public function messages() 
    {
        return [
            'identiteDeclarant.required' => 'L\'image de votre naissance est obligatoire.',
            'identiteDeclarant.image' => 'L\'image doit être une image.',
            'identiteDeclarant.mimes' => 'L\'image doit être au format PNG, JPG, ou JPEG.',
            'identiteDeclarant.max' => 'L\'image ne doit pas dépasser 300 Ko.',
        ];
    }
}
