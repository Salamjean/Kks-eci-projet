<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\AgenceCnps;
use App\Models\Alert;
use App\Models\CnpsAgent;
use App\Models\CnpsSearchHistory;
use App\Models\DecesHop;
use App\Models\ResetCodePasswordAgenceCnps;
use App\Models\ResetCodePasswordCnpsAgent;
use App\Notifications\SendEmailToAgenceCnpsAfterRegistrationNotification;
use App\Notifications\SendEmailToCnpsAgentAfterRegistrationNotification;
use Exception;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class AgenceCnpsController extends Controller
{
    public function create(){
        $alerts = Alert::all();
        return view('superadmin.agences.cnps.create', compact('alerts'));
     }

     public function store(Request $request){
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agence_cnps,email',
            'contact' => 'required|string|max:10',
            'agence_name' => 'required|string|max:255|unique:agence_cnps,agence_name',
            'profile_picture' => 'nullable|image|max:2048',
        ],[
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'e-mail est obligatoire.',
            'email.email' => 'L\'e-mail n\'est pas valide.',
            'email.unique' => 'L\'e-mail est déjà utilisé.',
            'contact.required' => 'Le numéro de contact est obligatoire.',
            'contact.string' => 'Le numéro de contact doit être une chaîne de caractères.',
            'contact.max' => 'Le contact doit être au maximum 10 caractères.',
            'agence_name.required' => 'Le nom de l\'agence est obligatoire.',
            'agence_name.string' => 'Le nom de l\'agence doit être une chaîne de caractères.',
            'agence_name.max' => 'Le nom de l\'agence ne doit pas dépasser 255 caractères.',
            'agence_name.unique' => 'Ce nom de l\'agence est déjà utilisé.',
        ]);
        try {
            // Récupérer le vendor connecté
            $cnps = Auth::guard('cnps')->user();
    
            if (!$cnps || !$cnps->siege) {
                return redirect()->back()->withErrors(['error' => 'Impossible de récupérer les informations du vendor.']);
            }
            // Création du docteur
            $agence = new AgenceCnps();
            $agence->name = $request->name;
            $agence->email = $request->email;
            $agence->contact = $request->contact;
            $agence->agence_name = $request->agence_name;
            $agence->password = Hash::make('default');
            
            if ($request->hasFile('profile_picture')) {
                $agence->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
            }
            $agence->siege = $cnps->siege;
            
            $agence->save();
            // Envoi de l'e-mail de vérification
            ResetCodePasswordAgenceCnps::where('email', $agence->email)->delete();
            $code = rand(10000, 40000);
            ResetCodePasswordAgenceCnps::create([
                'code' => $code,
                'email' => $agence->email,
            ]);
            Notification::route('mail', $agence->email)
                ->notify(new SendEmailToAgenceCnpsAfterRegistrationNotification($code, $agence->email));
            return redirect()->route('cnpsagences.index')
                ->with('success', 'Agence enregistré avec succès.');
        } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => 'Une erreur est survenue lors de l\'enregistrement.
              Veuillez consulter les logs pour plus d\'informations.']);
        }
    }

    public function index()
    {
        $admin = Auth::guard('cnps')->user();
    
        $alerts = Alert::all();
        $agences = AgenceCnps::whereNull('archived_at')
            ->where('siege', $admin->siege)
            ->paginate(10);
    
        // Retourner la vue avec les données
        return view('superadmin.agences.cnps.index', compact('agences', 'alerts'));
    }

    public function edit(AgenceCnps $agence){
        $alerts = Alert::all();
        return view('superadmin.agences.cnps.edit', compact('agence','alerts'));
     }

     public function update(Request $request ,AgenceCnps $agence){
        try {
            $agence->name = $request->name;
            $agence->email = $request->email;
            $agence->contact = $request->contact;
            $agence->siege = $request->siege;
            $agence->agence_name = $request->agence_name;
            $agence->update();
            return redirect()->route('cnpsagences.index')->with('success','Les informations de l\'agence mises à jour avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la modification de l\'agent de la cnps');
        }
     }

     public function archive(AgenceCnps $agence){
        try {
            $agence->archive();
            return redirect()->route('cnpsagences.index')->with('success1','Agence Supprimée avec succès.');
        } catch (Exception $e) {
            dd($e);
            throw new Exception('error','Une erreur est survenue lors de la archivation agence');
        }
     }

     public function defineAccess($email){
        //Vérification si le l'agent existe déjà
        $checkSousadminExiste = AgenceCnps::where('email', $email)->first();
        if($checkSousadminExiste){
            return view('superadmin.agences.cnps.auth.validate', compact('email'));
        }else{
            return redirect()->route('cnpsagences.login');
        };
    }

    public function submitDefineAccess(Request $request){

        // Validation des données
        $request->validate([
                'code'=>'required|exists:reset_code_password_agence_cnps,code',
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
            $agence = AgenceCnps::where('email', $request->email)->first();
    
            if ($agence) {
                // Mise à jour du mot de passe
                $agence->password = Hash::make($request->password);
    
                // Vérifier si une image est uploadée
                if ($request->hasFile('profile_picture')) {
                    // Supprimer l'ancienne photo si elle existe
                    if ($agence->profile_picture) {
                        Storage::delete('public/' . $agence->profile_picture);
                    }
    
                    // Stocker la nouvelle image
                    $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                    $agence->profile_picture = $imagePath;
                }
                $agence->update();
    
                if($agence){
                   $existingcodeagent =  ResetCodePasswordAgenceCnps::where('email', $agence->email)->count();
    
                   if($existingcodeagent > 1){
                    ResetCodePasswordAgenceCnps::where('email', $agence->email)->delete();
                   }
                }
    
                return redirect()->route('cnpsagences.login')->with('success', 'Compte mis à jour avec succès');
            } else {
                return redirect()->route('cnpsagences.login')->with('error', 'Email inconnu');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
    public function dashboard(Request $request)
{
    // Vérifier si l'utilisateur est connecté
    $agenceName = Auth::guard('agencecnps')->user()->agence_name;
    $deceshops = DecesHop::count();

    // Récupérer les données de l'agent
    $agents = CnpsAgent::where('communeM', $agenceName)->count();
    $rechercheInfo = CnpsSearchHistory::latest()->take(7)->get();
    // Récupérer les alertes
    $alerts = Alert::all();

    // Passer les données à la vue
    return view('superadmin.agences.cnps.dashboard', compact('alerts', 'agents','deceshops','rechercheInfo'));

}
function indexdeclaration(){
    $deceshops = DecesHop::all();
    return view('superadmin.agences.cnps.cnpsindex', compact('deceshops'));
}

public function historique(){
    $rechercheInfo = CnpsSearchHistory::latest()->paginate(15);
    return view('superadmin.agences.cnps.historique', compact('rechercheInfo'));
}

    public function logout(){
        Auth::guard('agencecnps')->logout();
        return redirect()->route('cnpsagences.login');
    }

    public function login(){
        return view('superadmin.agences.cnps.auth.login');
    }
    
    public function handleLogin(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'email' => 'required|exists:agence_cnps,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Le mail est obligatoire.',
            'email.exists' => 'Cette adresse mail n\'existe pas.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);
    
        try {
            // Récupérer l'agent par son email
            $agence = AgenceCnps::where('email', $request->email)->first();
    
            // Vérifier si l'agent est archivé
            if ($agence && $agence->archived_at !== null) {
                return redirect()->back()->with('error', 'Votre compte a été supprimé. Vous ne pouvez pas vous connecter.');
            }
    
            // Tenter la connexion
            if (auth('agencecnps')->attempt($request->only('email', 'password'))) {
                return redirect()->route('cnpsagences.dashboard')->with('success', 'Bienvenue sur votre page.');
            } else {
                return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
            }
        } catch (Exception $e) {
            // Gérer les erreurs
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la connexion.');
        }
    }

    public function download($id)
{
    // Récupérer l'objet DecesHop
    $decesHop = DecesHop::findOrFail($id);

    // Récupérer les informations du sous-admin connecté (celui qui télécharge le PDF)
    $agencecnps = Auth::guard('agencecnps')->user();

    if (!$agencecnps) {
        return back()->withErrors(['error' => 'Agence non authentifié.']);
    }

    // Récupérer les informations du docteur (sous_admin) qui a fait la déclaration
    $sousadmin = $decesHop->sous_admin; // Utilisez la relation "sousAdmin" définie dans le modèle DecesHop

    if (!$sousadmin) {
        return back()->withErrors(['error' => 'Docteur non trouvé.']);
    }

    // Générer le PDF avec les données
    $pdf = PDF::loadView('superadmin.agences.cnps.pdf', compact('decesHop', 'sousadmin', 'agencecnps'));

    // Retourner le PDF pour téléchargement direct
    return $pdf->download("statistique_agences_cnps_{$decesHop->id}.pdf");
}
}
