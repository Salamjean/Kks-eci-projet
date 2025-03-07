<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAjointrequest;
use App\Models\Alert;
use App\Models\Livraison;
use App\Models\ResetCodePasswordLivraison;
use App\Notifications\SendEmailToLivraisonAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class LivraisonController extends Controller
{
    public function create(){
        $alerts = Alert::all();
        return view('vendor.livraison.create', compact('alerts'));
     }

     public function store(Request $request){
        // Validation des données
       
        $request->validate([
           'name' => 'required|string|max:255',
           'prenom' => 'required|string|max:255',
           'email' => 'required|email|unique:livraisons,email',
           'contact' => 'required|string|min:10',
           'commune' => 'required|string|max:255',
           
       
       ]);
       try {
           // Récupérer le vendor connecté
           $vendor = Auth::guard('vendor')->user();
           if (!$vendor || !$vendor->name) {
               return redirect()->back()->withErrors(['error' => 'Impossible de récupérer les informations du vendor.']);
           }
           // Création du docteur
           $livraison = new Livraison();
           $livraison->name = $request->name;
           $livraison->prenom = $request->prenom;
           $livraison->email = $request->email;
           $livraison->contact = $request->contact;
           $livraison->password = Hash::make('default');
           
           if ($request->hasFile('profile_picture')) {
               $livraison->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
           }
           $livraison->commune = $request->commune;
           $livraison->communeM = $vendor->name;
           
           $livraison->save();
           // Envoi de l'e-mail de vérification
           ResetCodePasswordLivraison::where('email', $livraison->email)->delete();
           $code = rand(100000, 400000);
           ResetCodePasswordLivraison::create([
               'code' => $code,
               'email' => $livraison->email,
           ]);
           Notification::route('mail', $livraison->email)
               ->notify(new SendEmailToLivraisonAfterRegistrationNotification($code, $livraison->email));
           return redirect()->route('livraison.index')
               ->with('success', 'Livreur enregistré avec succès.');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
       }
    }

    public function index(){
        $admin = Auth::guard('vendor')->user();
        $alerts = Alert::all();
        $livraisons = Livraison::whereNull('archived_at')
            ->where('communeM', $admin->name)
            ->paginate(10);
        return view('vendor.livraison.index', compact('livraisons','alerts'));
     }

     public function edit(Livraison $livraison){
        $alerts = Alert::all();
        return view('vendor.livraison.edit', compact('livraison','alerts'));
     }

     public function update(UpdateAjointrequest $request ,Livraison $livraison){
        try {
            $livraison->name = $request->name;
            $livraison->prenom = $request->prenom;
            $livraison->email = $request->email;
            $livraison->contact = $request->contact;
            $livraison->commune = $request->commune;
            $livraison->update();
            return redirect()->route('livraison.index')->with('success','Les informations du livreur mises à jour avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la modification du livreur');
        }
     }

     public function delete(Livraison $livraison){
        try {
            $livraison->archive();
            return redirect()->route('livraison.index')->with('success1','Livreur supprimé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la suppression livreur');
        }
     }

     public function dashboard(Request $request) {
        return view('vendor.livraison.dashboard');
    }

    public function logout(){
        Auth::guard('livraison')->logout();
        return redirect()->route('livraison.login');
    }

    public function login(){
        return view('vendor.livraison.auth.login');
    }

    public function handleLogin(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'email' => 'required|exists:livraisons,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Le mail est obligatoire.',
            'email.exists' => 'Cette adresse mail n\'existe pas.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);
    
        try {
            // Récupérer l'adjoint par son email
            $livraison = Livraison::where('email', $request->email)->first();
    
            // Vérifier si l'adjoint est archivé
            if ($livraison && $livraison->archived_at !== null) {
                return redirect()->back()->with('error', 'Votre compte a été supprimé. Vous ne pouvez pas vous connecter.');
            }
    
            // Tenter la connexion
            if (auth('livraison')->attempt($request->only('email', 'password'))) {
                return redirect()->route('livraison.dashboard')->with('success', 'Bienvenue sur votre page.');
            } else {
                return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
            }
        } catch (Exception $e) {
            // Gérer les erreurs
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la connexion.');
        }
    }

    public function defineAccess($email){
        //Vérification si le sous-admin existe déjà
        $checkSousadminExiste = Livraison::where('email', $email)->first();
    
        if($checkSousadminExiste){
            return view('vendor.livraison.auth.register', compact('email'));
        }else{
            return redirect()->route('livraison.login');
        };
    }

    public function submitDefineAccess(Request $request){

        // Validation des données
        $request->validate([
                'code'=>'required|exists:reset_code_password_livraisons,code',
                'password' => 'required|same:confirme_password',
                'confirme_password' => 'required|same:password',
               
            ], [
                'code.exists' => 'Le code de réinitialisation est invalide.',
                'code.required' => 'Le code de réinitialisation est obligatoire verifié votre mail.',
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.same' => 'Les mots de passe doivent être identiques.',
                'confirme_password.same' => 'Les mots de passe doivent être identiques.',
                'confirme_password.required' => 'Le mot de passe de confirmation est obligatoire.',
               
        ]);
        try {
            $livraison = Livraison::where('email', $request->email)->first();
    
            if ($livraison) {
                // Mise à jour du mot de passe
                $livraison->password = Hash::make($request->password);
    
                // Vérifier si une image est uploadée
                if ($request->hasFile('profile_picture')) {
                    // Supprimer l'ancienne photo si elle existe
                    if ($livraison->profile_picture) {
                        Storage::delete('public/' . $livraison->profile_picture);
                    }
    
                    // Stocker la nouvelle image
                    $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                    $livraison->profile_picture = $imagePath;
                }
                $livraison->update();
    
                if($livraison){
                   $existingcodeajoint =  ResetCodePasswordLivraison::where('email', $livraison->email)->count();
    
                   if($existingcodeajoint > 1){
                    ResetCodePasswordLivraison::where('email', $livraison->email)->delete();
                   }
                }
    
                return redirect()->route('livraison.login')->with('success', 'Compte mis à jour avec succès');
            } else {
                return redirect()->route('livraison.login')->with('error', 'Email inconnu');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function effectuerlivraison(){
        return view('vendor.livraison.effectuerlivraison');
    }

    public function livraisoneffectuer(){
        return view('vendor.livraison.livraisoneffectuer');
    }


    public function livraisonnoneffectuer(){
        return view('vendor.livraison.livraisonnoneffectuer');
    }


}
