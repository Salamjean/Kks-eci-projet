<?php

namespace App\Http\Controllers;

use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Agent;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Doctor;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\ResetCodePasswordAgent;
use App\Models\ResetCodePasswordHop;
use App\Models\ResetPAsswordHop;
use App\Models\Vendor;
use App\Notifications\SendEmailToAgentAfterRegistrationNotification;
use App\Notifications\SendEmailToDoctorAfterRegistrationNotification;
use App\Notifications\SendEmailToHopitalAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    //pour les vues de doctor
    public function dashboard(){
        return view('vendor.dashboard');
    }


    // Pour l'authentification
    
    public function register(){
        return view('vendor.auth.register');
    }

    public function login(){
        return view('vendor.auth.login');
    }


    public function handleRegister(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail existe déjà.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);
    
        try {
            // Création du nouveau compte
            Vendor::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Redirection avec un message de succès
            return redirect()->route('vendor.login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez vous connecter.');
        } catch (\Exception $e) {
            // En cas d'erreur inattendue
            return back()->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.'])->withInput();
        }
    }
    

    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' =>'required|exists:vendors,email',
            'password' => 'required|min:8',
        ], [
            
            
            'email.required' => 'Le mail est obligatoire.',
            'email.exists' => 'Cette adresse mail n\'existe pas.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min'=> 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);

        try {
            if(auth('vendor')->attempt($request->only('email', 'password')))
            {
                return redirect()->route('vendor.dashboard')->with('Bienvenu sur votre page ');
            }else{
                return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

//Naissance edit 
    public function edit($id)
{
    $alerts = Alert::all();
    $naissance = Naissance::findOrFail($id);

    // Les états possibles à afficher dans le formulaire
    $etats = ['en attente', 'réçu', 'terminé'];

    return view('naissances.edit', compact('naissance', 'etats','alerts'));
}
    public function updateEtat(Request $request, $id)
{
    $naissance = Naissance::findOrFail($id);
    
    // Validation de l'état (si nécessaire)
    $request->validate([
        'etat' => 'required|string|in:en attente,réçu,terminé', // Ajouter les états possibles
    ]);

    // Mise à jour de l'état
    $naissance->etat = $request->etat;
    $naissance->save();
    
    return redirect()->route('naissance.index')->with('success', "Etat de la demande a été mis à jour.");
}

//NaissanceD edit 
    public function edit1($id)
{
    $alerts = Alert::all();
    $naissanced = NaissanceD::findOrFail($id);

    // Les états possibles à afficher dans le formulaire
    $etats = ['en attente', 'réçu', 'terminé'];

    return view('naissanced.edit', compact('naissanced', 'etats','alerts'));
}
    public function updateEtat1(Request $request, $id)
{
    $naissanced = NaissanceD::findOrFail($id);
    
    // Validation de l'état (si nécessaire)
    $request->validate([
        'etat' => 'required|string|in:en attente,réçu,terminé', // Ajouter les états possibles
    ]);

    // Mise à jour de l'état
    $naissanced->etat = $request->etat;
    $naissanced->save();
    
    return redirect()->route('naissance.index')->with('success', 'Etat de la demande a été mis à jour.');
}

//Deces edit 
    public function edit2($id)
{
    $alerts = Alert::all();
    $deces = Deces::findOrFail($id);

    // Les états possibles à afficher dans le formulaire
    $etats = ['en attente', 'réçu', 'terminé'];

    return view('deces.edit', compact('deces', 'etats','alerts'));
}
    public function updateEtat2(Request $request, $id)
{
    $deces = Deces::findOrFail($id);
    
    // Validation de l'état (si nécessaire)
    $request->validate([
        'etat' => 'required|string|in:en attente,réçu,terminé', // Ajouter les états possibles
    ]);

    // Mise à jour de l'état
    $deces->etat = $request->etat;
    $deces->save();
    
    return redirect()->route('deces.index')->with('success', 'Etat de la demande a été mis à jour.');
}


//Mariage edit 
    public function edit3($id)
{
    $alerts = Alert::all();
    $mariage = Mariage::findOrFail($id);

    // Les états possibles à afficher dans le formulaire
    $etats = ['en attente', 'réçu', 'terminé'];

    return view('mariages.edit', compact('mariage', 'etats','alerts'));
}
    public function updateEtat3(Request $request, $id)
{
    $mariage = Mariage::findOrFail($id);
    
    // Validation de l'état (si nécessaire)
    $request->validate([
        'etat' => 'required|string|in:en attente,réçu,terminé', // Ajouter les états possibles
    ]);

    // Mise à jour de l'état
    $mariage->etat = $request->etat;
    $mariage->save();
    
    return redirect()->route('mariage.index')->with('success', 'Etat de la demande a été mis à jour.');
}

public function hoptitalcreate(){
    $alerts = Alert::all();
    $doctors = Doctor::all();
    return view('vendor.hoptital.create', compact('alerts','doctors'));
}
public function hoptitalstore(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:doctors,email',
        'contact' => 'required|string|min:10',
        'nomHop' => 'required|string|max:255',
        'commune' => 'required|string|max:255',
        'profile_picture' => 'nullable|image|max:2048',
    
    ]);

    try {
        // Récupérer le vendor connecté
        $vendor = Auth::guard('vendor')->user();

        if (!$vendor) {
            return redirect()->back()->withErrors(['error' => 'Impossible de récupérer les informations du vendor.']);
        }

        // Création du docteur
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->contact = $request->contact;
        $doctor->password = Hash::make('default');
        
        if ($request->hasFile('profile_picture')) {
            $doctor->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $doctor->nomHop = $request->nomHop;
        $doctor->commune = $request->commune;
        $doctor->save();

        // Envoi de l'e-mail de vérification
        ResetCodePasswordHop::where('email', $doctor->email)->delete();
        $code = rand(10000, 40000);

        ResetCodePasswordHop::create([
            'code' => $code,
            'email' => $doctor->email,
        ]);

        Notification::route('mail', $doctor->email)
            ->notify(new SendEmailToHopitalAfterRegistrationNotification($code, $doctor->email));

        return redirect()->route('vendor.hoptitalcreate')
            ->with('success', 'Hôpital enregistré avec succès.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
    }
}

public function defineAccess($email){
    //Vérification si le sous-admin existe déjà
    $checkSousadminExiste = Doctor::where('email', $email)->first();

    if($checkSousadminExiste){
        return view('doctor.auth.register', compact('email'));
    }else{
        return redirect()->route('doctor.login');
    };
}

public function submitDefineAccess(Request $request){

    // Validation des données
    $request->validate([
            'code'=>'required|exists:reset_code_password_hops,code',
            'password' => 'required|same:confirme_password',
            'confirme_password' => 'required|same:password',
            'profile_picture' => 'required|image|mimes:png,jpg'
        ], [
            'code.exists' => 'Le code de réinitialisation est invalide.',
            'password.same' => 'Les mots de passe doivent être identiques.',
            'confirme_password.same' => 'Les mots de passe doivent être identiques.',
            'profile_picture.image' => 'Le format de l\'image doit être PNG ou JPG.',
    ]);
    try {
        $doctor = Doctor::where('email', $request->email)->first();

        if ($doctor) {
            // Mise à jour du mot de passe
            $doctor->password = Hash::make($request->password);

            // Vérifier si une image est uploadée
            if ($request->hasFile('profile_picture')) {
                // Supprimer l'ancienne photo si elle existe
                if ($doctor->profile_picture) {
                    Storage::delete('public/' . $doctor->profile_picture);
                }

                // Stocker la nouvelle image
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $doctor->profile_picture = $imagePath;
            }
            $doctor->update();

            if($doctor){
               $existingcodehop =  ResetCodePasswordHop::where('email', $doctor->email)->count();

               if($existingcodehop > 1){
                ResetCodePasswordHop::where('email', $doctor->email)->delete();
               }
            }

            return redirect()->route('doctor.login')->with('success', 'Compte mis à jour avec succès');
        } else {
            return redirect()->route('doctor.login')->with('error', 'Email inconnu');
        }
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

}
