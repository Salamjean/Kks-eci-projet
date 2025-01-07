<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Alert;
use App\Models\Caisse;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\ResetCodePasswordAgent;
use App\Models\ResetCodePasswordCaisse;
use App\Notifications\SendEmailToCaisseAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class CaisseController extends Controller
{
    public function caissecreate(){
        $alerts = Alert::all();
        return view('vendor.caisse.create', compact('alerts'));
     }
     public function caisseindex(){
        $admin = Auth::guard('vendor')->user();
        $alerts = Alert::all();
        $caisses = Caisse::where('communeM', $admin->name)->paginate(10);
        return view('vendor.caisse.index', compact('caisses','alerts'));
     }

     public function caissestore(Request $request){
        // Validation des données
       
        $request->validate([
           'name' => 'required|string|max:255',
           'prenom' => 'required|string|max:255',
           'email' => 'required|email|unique:agents,email',
           'contact' => 'required|string|min:10',
           'commune' => 'required|string|max:255',
           'profile_picture' => 'nullable|image|max:2048',
       
       ]);
   
       try {
           // Récupérer le vendor connecté
           $vendor = Auth::guard('vendor')->user();
   
           if (!$vendor || !$vendor->name) {
               return redirect()->back()->withErrors(['error' => 'Impossible de récupérer les informations du vendor.']);
           }
   
           // Création du docteur
           $caisse = new Caisse();
           $caisse->name = $request->name;
           $caisse->prenom = $request->prenom;
           $caisse->email = $request->email;
           $caisse->contact = $request->contact;
           $caisse->password = Hash::make('default');
           
           if ($request->hasFile('profile_picture')) {
               $caisse->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
           }
   
           $caisse->commune = $request->commune;
           $caisse->communeM = $vendor->name;
           
           $caisse->save();
   
           // Envoi de l'e-mail de vérification
           ResetCodePasswordCaisse::where('email', $caisse->email)->delete();
           $code1 = rand(10000, 40000);
           $code = $code1.''.$caisse->id;
   
           ResetCodePasswordCaisse::create([
               'code' => $code,
               'email' => $caisse->email,
           ]);
   
           Notification::route('mail', $caisse->email)
               ->notify(new SendEmailToCaisseAfterRegistrationNotification($code, $caisse->email));
   
           return redirect()->route('caisse.index')
               ->with('success', 'Caissié enregistré avec succès.');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
       }
    }
    public function caisseedit(Caisse $caisse){
        $alerts = Alert::all();
        return view('vendor.caisse.edit', compact('caisse','alerts'));
     }

     public function caisseupdate(UpdateAgentRequest $request ,Caisse $caisse){
        try {
            $caisse->name = $request->name;
            $caisse->prenom = $request->prenom;
            $caisse->email = $request->email;
            $caisse->contact = $request->contact;
            $caisse->commune = $request->commune;
            $caisse->update();
    
            return redirect()->route('caisse.index')->with('success','Les informations du caissié mises à jour avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la modification du Docteur');
        }
     }

     public function caissedelete(Caisse $caisse){
        try {
            $caisse->delete();
            return redirect()->route('caisse.index')->with('success1','Caissié supprimé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la suppression ajoint');
        }
     }    
     public function dashboard() {
        $admin = Auth::guard('caisse')->user();
        $alerts = Alert::all();
        $caisses = Caisse::where('communeM', $admin->communeM)->paginate(10);
        $decesnombre = Deces::where('commune', $admin->communeM)->count();
        $decesdejanombre = Decesdeja::where('commune', $admin->communeM)->count();
        $mariagenombre = Mariage::where('commune', $admin->communeM)->count();
        $naissancenombre = Naissance::where('commune', $admin->communeM)->count();
        $naissanceDnombre = NaissanceD::where('commune', $admin->communeM)->count();
        $total = $decesnombre + $decesdejanombre + $naissancenombre + $naissanceDnombre + $mariagenombre;
    
        // Solde initial
        $soldeActuel = 300000;
    
        // Déduction pour chaque nouvelle demande
        $debit = 500; // Montant à déduire pour chaque demande
        $soldeDebite = $total * $debit; // Total débité basé sur le nombre de demandes
        $soldeRestant = $soldeActuel - $soldeDebite; // Calcul du solde restant
    
        // Récupérer les demandes récentes
        $demandesNaissance1 = Naissance::where('commune', $admin->communeM)->latest()->take(3)->get();
        $demandesNaissanceD = NaissanceD::where('commune', $admin->communeM)->latest()->take(2)->get();
        $demandesNaissance = $demandesNaissance1->concat($demandesNaissanceD);
        $demandesDeces1 = Deces::where('commune', $admin->communeM)->latest()->take(5)->get();
        $demandesDecesdeja = Decesdeja::where('commune', $admin->communeM)->latest()->take(5)->get();
        $demandesDeces = $demandesDeces1->concat($demandesDecesdeja);
        $demandesMariage = Mariage::where('commune', $admin->communeM)->latest()->take(5)->get();
    
        return view('vendor.caisse.dashboard', compact('alerts', 'total', 'soldeActuel', 'soldeDebite', 'soldeRestant',
            'decesnombre', 'decesdejanombre', 'naissancenombre', 'naissanceDnombre', 'mariagenombre', 
            'demandesNaissance', 'demandesDeces', 'demandesMariage'));
    }
     public function logout(){
        Auth::guard('caisse')->logout();
        return redirect()->route('caisse.login');
    }
    public function login(){
        return view('vendor.caisse.auth.login');
    }

    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' =>'required|exists:caisses,email',
            'password' => 'required|min:8',
        ], [
            
            
            'email.required' => 'Le mail est obligatoire.',
            'email.exists' => 'Cette adresse mail n\'existe pas.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min'=> 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);
        try {
            if(auth('caisse')->attempt($request->only('email', 'password')))
            {
                return redirect()->route('caisse.dashboard')->with('Bienvenu sur votre page ');
            }else{
                return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function defineAccess($email){
        //Vérification si le sous-admin existe déjà
        $checkSousadminExiste = Caisse::where('email', $email)->first();
    
        if($checkSousadminExiste){
            return view('vendor.caisse.auth.register', compact('email'));
        }else{
            return redirect()->route('caisse.login');
        };
    }

    public function submitDefineAccess(Request $request){
        // Validation des données
        $request->validate([
                'code'=>'required|exists:reset_code_password_caisses,code',
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
            $caisse = Caisse::where('email', $request->email)->first();
        
            if ($caisse) {
                // Mise à jour du mot de passe
                $caisse->password = Hash::make($request->password);
        
                // Vérifier si une image est uploadée
                if ($request->hasFile('profile_picture')) {
                    // Supprimer l'ancienne photo si elle existe
                    if ($caisse->profile_picture) {
                        Storage::delete('public/' . $caisse->profile_picture);
                    }
        
                    // Stocker la nouvelle image
                    $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                    $caisse->profile_picture = $imagePath;
                }
                $caisse->update();
        
                if($caisse){
                   $existingcodeajoint =  ResetCodePasswordCaisse::where('email', $caisse->email)->count();
        
                   if($existingcodeajoint > 1){
                    ResetCodePasswordCaisse::where('email', $caisse->email)->delete();
                   }
                }
        
                return redirect()->route('caisse.login')->with('success', 'Compte mis à jour avec succès');
            } else {
                return redirect()->route('caisse.login')->with('error', 'Email inconnu');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}
