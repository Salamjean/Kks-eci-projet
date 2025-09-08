<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\welcomeMail;
use App\Models\User;
use App\Models\Utilisateur;
use App\Models\verifyToken;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données
        $validated = $request->validate([
            'name' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users,email',
            'commune' => 'required',
            'indicatif' => 'required',
            'contact' => 'required',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',      // Doit contenir au moins une minuscule
                'regex:/[A-Z]/',      // Doit contenir au moins une majuscule
                'regex:/[0-9]/',      // Doit contenir au moins un chiffre
                'regex:/[@$!%*#?&.]/', // Doit contenir au moins un caractère spécial
            ],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ],[
            'name.required' => 'Le nom est obligatoire.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'email.unique' => 'Cette adresse e-mail est déjà associée à un compte.',
            'commune.required' => 'La commune de naissance est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'indicatif.required' => 'indicatif du pays est obligatoire.',
            'contact.required' => 'contact est obligatoire.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.', // Message d'erreur personnalisé pour regex
            'profile_picture.image' => 'Le fichier doit être une image.',
            'profile_picture.mimes' => 'L\'image doit être au format jpeg, png, jpg, gif ou svg.',
            'profile_picture.max' => 'L\'image ne doit pas dépasser 2048 KB.',
        ]);
        // Création de l'utilisateur
        try {
            $profilePicturePath = null;
            if ($request->hasFile('profile_picture')) {
                $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                Log::info('Profile picture stored at: ' . $profilePicturePath);
            }
            
            $users = new User();
            $users->name = $request->name;
            $users->prenom = $request->prenom;
            $users->email = $request->email;
            $users->commune = $request->commune;
            $users->indicatif = $request->indicatif;
            $users->contact = $request->contact;
            $users->CMU = $request->CMU;
            $users->password = Hash::make($request->password);
            $users->profile_picture = $profilePicturePath;
            $users->save();

            return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez vous connecter.');

        } catch (\Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.'])->withInput();
        }
    }
}