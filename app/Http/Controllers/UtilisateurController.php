<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\User;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UtilisateurController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();
        
            // Récupérer les naissances et les marquer avec le type "naissance"
            $naissances = Naissance::where('user_id', $user->id)->get()->map(function ($naissance) {
                $naissance->type = 'naissance';
                return $naissance;
            });
        
            // Récupérer les naissances différées et les marquer avec le type "naissanceD"
            $naissancesD = NaissanceD::where('user_id', $user->id)->get()->map(function ($naissanceD) {
                $naissanceD->display_type = 'naissanceD'; // Utilise une nouvelle propriété pour l'affichage
                return $naissanceD;
            });
        
            // Récupérer les décès et les marquer avec le type "deces"
            $deces = Deces::where('user_id', $user->id)->get()->map(function ($deces) {
                $deces->type = 'deces';
                return $deces;
            });

            $decesdeja = Decesdeja::where('user_id', $user->id)->get()->map(function ($decesdeja) {
                $decesdeja->type = 'deces';
                return $decesdeja;
            });
        
            // Récupérer les mariages et les marquer avec le type "mariage"
            $mariages = Mariage::where('user_id', $user->id)->get()->map(function ($mariage) {
                $mariage->type = 'mariage';
                return $mariage;
            });
        
            // Combiner toutes les collections
            $demandes = $naissances->concat($naissancesD)->concat($deces)->concat($mariages);
            $naissancesCount = Naissance::where('user_id', $user->id)->count();
            $naissanceDCount = NaissanceD::where('user_id', $user->id)->count();
            $decesCount = Deces::where('user_id', $user->id)->count();
            $decesdejaCount = Decesdeja::where('user_id', $user->id)->count();
            $mariageCount = Mariage::where('user_id', $user->id)->count();
            // Compter le nombre total de demandes
            $nombreDemandes = $demandes->count();
        
            return view('utilisateur.dashboard', compact('user', 'demandes', 'nombreDemandes',
            'naissancesD','naissancesCount','naissanceDCount','decesCount','decesdejaCount','mariageCount'));
        }
        
        return redirect()->route('login');
    }
    public function handleRegister(Request $request)
{
    $request->validate([
        'name' => 'required',
        'prenom' => 'required',
        'email' => 'required|email|unique:users,email', // Assurez-vous que la table est correcte
        'password' => 'required|min:8',
        'nomHop' => 'required',
        'commune' => 'required',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], [
        'name.required' => 'Le nom est obligatoire.',
        'prenom.required' => 'Le prénom est obligatoire.',
        'email.required' => 'L\'adresse e-mail est obligatoire.',
        'email.email' => 'Veuillez fournir une adresse e-mail valide.',
        'email.unique' => 'Cette adresse e-mail existe déjà.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        'profile_picture.image' => 'La photo de profil doit être une image.',
        'profile_picture.mimes' => 'Les formats d\'image autorisés sont jpeg, png, jpg, gif, svg.',
        'profile_picture.max' => 'L\'image ne doit pas dépasser 2 Mo.',
        'nomHop.required' => 'Le nom de l\'hôpital est obligatoire.',
        'commune.required' => 'La commune est obligatoire.',
    ]);

    try {
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            Log::info('Profile picture stored at: ' . $profilePicturePath);
        }

        $utilisateur = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'commune' => $request->commune,
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez vous connecter.');

    } catch (\Exception $e) {
        Log::error('Error during registration: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.'])->withInput();
    }
}
}