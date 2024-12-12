<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class saveNaissanceDRequest extends FormRequest
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
            'type' => 'required',
            'name' => 'required',
            'number' => 'required',
            
        ];
    }

    public function messages() 
    {
        return [
            'type.required' => 'le type d\'extrait que vous-voulez demander est obligatoire',
            'name.required' => 'Le nom est obligatoire',
            'number.required' => 'Le numéro de ton extrait est obligatoire est obligatoire',
        ];
    }
}
