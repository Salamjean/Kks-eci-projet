<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class submitDefineAccessRequest extends FormRequest
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
            'code'=>'required|exists:reset_code_passwords,code',
            'password' => 'required|same:confirme_password',
            'confirme_password' => 'required|same:password',
            'profile_picture' => 'required|image|mimes:png,jpg'
        ];
    }

    public function messages(){
        return [
            'code.required' => 'Code est obligatoire.',
            'code.exists' => 'Code Invalide, consultez votre boite mail.',
            'password.required' => 'Mot de passe obligatoire.',
            'password.same' => 'Mot de passe non identique.',
            'confirme_password.required' => 'Confirmation du mot de passe est obligatoire.',
            'confirme_password.same' => 'Mot de passe non identique.',
            'profile_picture.required' => 'La Photo de profil est obligatoire.',
            'profile_picture.image' => 'La photo doit être une image.',
            'profile_picture.mimes' => 'La photo doit être en PNG ou JPG .'
        ];
    }
}
