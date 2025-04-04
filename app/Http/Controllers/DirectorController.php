<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSousDoctorRequest;
use App\Models\DecesHop;
use App\Models\Director;
use App\Models\NaissHop;
use App\Models\ResetCodePasswordDirector;
use App\Models\SousAdmin;
use App\Notifications\SendEmailToDirectorAfterRegistrationNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class DirectorController extends Controller
{
    public function create(){
        $directors = Director::all();
        return view('directeur/create', compact('directors'));
    }

    public function dashboard(Request $request) {
        // Récupérer le sousadmin connecté
        $sousadmin = auth('directeur')->user();
        
        // Récupérer les détails du sousadmin
        $sousadminDetails = SousAdmin::find($sousadmin->id);
        
        // Récupérer le mois et l'année sélectionnés, ou la date actuelle par défaut
        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);
        
        // Compter le total des déclarations pour le mois sélectionné
        $communeAdmin = $sousadmin->nomHop;
        $docteur = SousAdmin::where('nomHop', $communeAdmin)
            ->whereYear('created_at', $selectedYear)
            ->count();
        $naisshop = NaissHop::where('NomEnf', $communeAdmin)
            ->whereYear('created_at', $selectedYear)
            ->count();
        $deceshop = DecesHop::where('nomHop', $communeAdmin)
            ->whereYear('created_at', $selectedYear)
            ->count();
        
        // Récupérer les données pour les graphiques
        $naissData = NaissHop::where('NomEnf', $communeAdmin)
           ->whereYear('created_at', $selectedYear)
           ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
           ->groupBy('month')
           ->orderBy('month')
           ->pluck('count', 'month')->toArray();
        
        // Remplir les données manquantes
        $naissData = array_replace(array_fill(1, 12, 0), $naissData);
        $total = $naisshop + $deceshop ;
        // Récupérer les données de décès
        $decesData = DecesHop::where('nomHop', $communeAdmin)
           ->whereYear('created_at', $selectedYear)
           ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
           ->groupBy('month')
           ->orderBy('month')
           ->pluck('count', 'month')->toArray();
        
        // Remplir les données manquantes
        $decesData = array_replace(array_fill(1, 12, 0), $decesData);
        
        // Passer les données à la vue
        return view('directeur.dashboard', compact('sousadminDetails', 'naisshop', 'deceshop', 'docteur', 'total',
            'selectedMonth', 'selectedYear', 'naissData', 'decesData'));
    }

    public function logout(){
        auth('directeur')->logout();
        return redirect()->route('directeur.login');
    }
    public function edit(Director $director){
        return view('directeur.edit', compact('director'));
    }

    public function update(UpdateSousDoctorRequest $request,Director $director){
        try {
            $director->name = $request->name;
            $director->prenom = $request->prenom;
            $director->email = $request->email;
            $director->contact = $request->contact;
            $director->update();
            return redirect()->route('directeur.create')->with('success','Vos informations ont été mises à jour avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la modification du director');
        }
    }

    public function delete(Director $director){
        try {
            $director->delete();
            return redirect()->route('directeur.create')->with('success1','Le directeur a été supprimé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la suppression du directeur');
        }
    }

    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:directors,email',
    ],[
        'name.required' => 'Le nom est requis.',
        'name.string' => 'Le nom doit être une chaîne de caractères.',
        'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        'prenom.required' => 'Le prénom est requis.',
        'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
        'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
        'email.required' => 'L\'adresse e-mail est requise.',
        'email.email' => 'L\'adresse e-mail n\'est pas valide.',
        'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
    ]);
    try {
        // Récupérer le docteur connecté
        $doctor = auth('doctor')->user();	
    
        if (!$doctor || !$doctor->nomHop || !$doctor->commune) {
            return redirect()->back()->withErrors(['error' => 'Impossible de récupérer le nom de l\'hôpital.']);
        }
    
        // Création du sous-admin
        $director = new Director();
        $director->name = $request->name;
        $director->prenom = $request->prenom;
        $director->email = $request->email;
        $director->password = Hash::make('default');
        $director->contact = $request->contact;
        $director->profile_picture = $request->profile_picture;
        $director->nomHop = $doctor->nomHop; // Associe le même nomHop que le docteur
        $director->commune = $doctor->commune; // Associe la commune du docteur
        $director->save();
    
        // Envoi de l'e-mail de vérification
        if ($director) {
            try {
                ResetCodePasswordDirector::where('email', $director->email)->delete();
                $code = rand(1000, 4000);
    
                $data = [
                    'code' => $code,
                    'email' => $director->email,
                ];
    
                ResetCodePasswordDirector::create($data);
    
                Notification::route('mail', $director->email)
                    ->notify(new SendEmailToDirectorAfterRegistrationNotification($code, $director->email));
    
                return redirect()->route('directeur.create')
                    ->with('success', 'Le directeur a été ajouté avec succès.');
            } catch (Exception $e) {
                throw new Exception('Une erreur est survenue lors de l\'envoi de l\'e-mail.');
            }
        }
    } catch (Exception $e) {
        throw new Exception('Une erreur est survenue lors de la création du sous-admin.');
    }
}

public function defineAccess($email){
    //Vérification si le sous-admin existe déjà
    $checkSousadminExiste = Director::where('email', $email)->first();

    if($checkSousadminExiste){
        return view('directeur.auth.register', compact('email'));
    }else{
        return redirect()->route('directeur.login');
    };
}

public function submitDefineAccess(Request $request){

    // Validation des données
    $request->validate([
            'code'=>'required|exists:reset_code_password_directors,code',
            'password' => 'required|same:confirme_password',
            'confirme_password' => 'required|same:password',
            'profile_picture' => 'required'
        ], [
            'code.exists' => 'Le code de réinitialisation est invalide.',
            'code.required' => 'Le code de réinitialisation est obligatoire verifié votre mail.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.same' => 'Les mots de passe doivent être identiques.',
            'confirme_password.same' => 'Les mots de passe doivent être identiques.',
            'confirme_password.required' => 'Le mot de passe de confirmation est obligatoire.',
            'profile_picture.required' => 'Votre photo de profil est obligatoire',
    ]);
    try {
        $director = Director::where('email', $request->email)->first();

        if ($director) {
            // Mise à jour du mot de passe
            $director->password = Hash::make($request->password);

            // Vérifier si une image est uploadée
            if ($request->hasFile('profile_picture')) {
                // Supprimer l'ancienne photo si elle existe
                if ($director->profile_picture) {
                    Storage::delete('public/' . $director->profile_picture);
                }

                // Stocker la nouvelle image
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $director->profile_picture = $imagePath;
            }
            $director->update();

            if($director){
               $existingcodedirector =  ResetCodePasswordDirector::where('email', $director->email)->count();

               if($existingcodedirector > 1){
                ResetCodePasswordDirector::where('email', $director->email)->delete();
               }
            }

            return redirect()->route('directeur.login')->with('success', 'Compte mis à jour avec succès');
        } else {
            return redirect()->route('directeur.login')->with('error', 'Email inconnu');
        }
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

public function register(){
    return view('directeur.auth.register');
}
public function login(){
    return view('directeur.auth.login');
}

public function handleRegister(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:directors,email',
        'password' => 'required|min:8',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
    ], [
        'name.required' => 'Le nom est obligatoire.',
        'email.required' => 'L\'adresse e-mail est obligatoire.',
        'email.email' => 'Veuillez fournir une adresse e-mail valide.',
        'email.unique' => 'Cette adresse e-mail existe déjà.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        'profile_picture.image' => 'La photo de profil doit être une image.',
        'profile_picture.mimes' => 'Les formats d\'image autorisés sont jpeg, png, jpg, gif, svg.',
        'profile_picture.max' => 'L\'image ne doit pas dépasser 2 Mo.',
    ]);
    
    try {
        // Traitement de la photo de profil si elle existe
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            // Générer un nom unique pour l'image et la sauvegarder dans le dossier 'profile_pictures'
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        
        // Création du nouveau compte
        $director = Director::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $profilePicturePath, // Sauvegarde du chemin de l'image
        ]);

        // Redirection avec un message de succès
        return redirect()->route('directeur.login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez vous connecter.');
        
    } catch (Exception $e) {
        // En cas d'erreur inattendue
        return back()->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.'])->withInput();
    }
}


public function handleLogin(Request $request)
{
    
    $request->validate([
        'email' =>'required|exists:directors,email',
        'password' => 'required|min:8',
    ], [
        'email.required' => 'Le mail est obligatoire.',
        'email.exists' => 'Cette adresse mail n\'existe pas.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
    ]);
    try {
        if(auth('directeur')->attempt($request->only('email', 'password')))
        {
            return redirect()->route('directeur.dashboard')->with('Bienvenu sur votre page ');
        }else{
            return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
        }
    } catch (Exception $e) {
        dd($e);
    }
}
public function directeurindex() {
    // Récupérer l'administrateur connecté
    $directors = auth('directeur')->user();
    
    // Récupérer la commune de l'administrateur
    $communeAdmin = $directors->nomHop; // Ajustez selon votre logique

    // Récupérer les sous-administrateurs filtrés par la commune
    $sousadmins = SousAdmin::where('nomHop', $communeAdmin)->get();

    return view('directeur.directeurindex', compact('sousadmins'));
}

public function profil(){
    $director = auth('directeur')->user(); // Récupérer le directeur connecté
    return view('directeur.auth.profil', compact('director'));
}
    
public function updateProfil(Request $request)
    {
    // Valider les données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' =>'required|string|max:255',
        'email' =>'required|email|max:255',
        'contact' =>'required|string|max:255',
        // Ajoutez d'autres champs si nécessaire
    ]); 
        try {
            $director = auth('directeur')->user();
            if (!$director) {
                return redirect()->back()->with('error', 'Utilisateur non trouvé.');
            }
            // Gestion de l'image de profil
            if ($request->hasFile('profile_picture')) {
                // Supprimer l'ancienne image si elle existe
                if ($director->profile_picture && Storage::exists('public/' . $director->profile_picture)) {
                    Storage::delete('public/' . $director->profile_picture);
                }
    
                // Stocker la nouvelle image
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $director->profile_picture = $imagePath;
                $director->save();
            }
            $director->name = $request->name;
            $director->prenom = $request->prenom;
            $director->email = $request->email;
            $director->contact = $request->contact;
            $director->update(); 
    
            return redirect()->route('directeur.profil')->with('success', 'Profil mis à jour avec succès.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
        }
    }
}
