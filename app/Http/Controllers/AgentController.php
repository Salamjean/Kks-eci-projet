<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Agent;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\DecesHop;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\NaissHop;
use App\Models\ResetCodePasswordAgent;
use App\Notifications\SendEmailToAgentAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    

 public function agentcreate(){
    $alerts = Alert::all();
    return view('vendor.agent.create', compact('alerts'));
 }

 public function agentstore(Request $request){
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
        $agent = new Agent();
        $agent->name = $request->name;
        $agent->prenom = $request->prenom;
        $agent->email = $request->email;
        $agent->contact = $request->contact;
        $agent->password = Hash::make('default');
        
        if ($request->hasFile('profile_picture')) {
            $agent->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $agent->commune = $request->commune;
        $agent->communeM = $vendor->name;
        
        $agent->save();

        // Envoi de l'e-mail de vérification
        ResetCodePasswordAgent::where('email', $agent->email)->delete();
        $code = rand(100000, 400000);

        ResetCodePasswordAgent::create([
            'code' => $code,
            'email' => $agent->email,
        ]);

        Notification::route('mail', $agent->email)
            ->notify(new SendEmailToAgentAfterRegistrationNotification($code, $agent->email));

        return redirect()->route('agent.index')
            ->with('success', 'Agent enregistré avec succès.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
    }
 }

 public function login(){
    return view('vendor.agent.auth.login');
}

public function handleLogin(Request $request)
{
    // Validation des champs du formulaire
    $request->validate([
        'email' => 'required|exists:agents,email',
        'password' => 'required|min:8',
    ], [
        'email.required' => 'Le mail est obligatoire.',
        'email.exists' => 'Cette adresse mail n\'existe pas.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
    ]);

    try {
        // Récupérer l'agent par son email
        $agent = Agent::where('email', $request->email)->first();

        // Vérifier si l'agent est archivé
        if ($agent && $agent->archived_at !== null) {
            return redirect()->back()->with('error', 'Votre compte a été supprimé. Vous ne pouvez pas vous connecter.');
        }

        // Tenter la connexion
        if (auth('agent')->attempt($request->only('email', 'password'))) {
            return redirect()->route('agent.vue')->with('success', 'Bienvenue sur votre page.');
        } else {
            return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
        }
    } catch (Exception $e) {
        // Gérer les erreurs
        return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la connexion.');
    }
}

    public function logout(){
        Auth::guard('agent')->logout();
        return redirect()->route('agent.login');
    }
    public function agentindex()
{
   
    $admin = Auth::guard('vendor')->user();

    $alerts = Alert::all();
    $agents = Agent::whereNull('archived_at')
        ->where('communeM', $admin->name)
        ->paginate(10);

    // Retourner la vue avec les données
    return view('vendor.agent.index', compact('agents', 'alerts'));
}
 public function agentedit(Agent $agent){
    $alerts = Alert::all();
    return view('vendor.agent.edit', compact('agent','alerts'));
 }

 public function agentupdate(UpdateAgentRequest $request ,Agent $agent){
    try {
        $agent->name = $request->name;
        $agent->prenom = $request->prenom;
        $agent->email = $request->email;
        $agent->contact = $request->contact;
        $agent->commune = $request->commune;
        $agent->update();

        return redirect()->route('agent.index')->with('success','Les informations agent mises à jour avec succès.');
    } catch (Exception $e) {
        // dd($e);
        throw new Exception('error','Une erreur est survenue lors de la modification du Docteur');
    }
 }

//  public function archive(Agent $agent){
    // try {
        // $agent->archive();
        // return redirect()->route('super_admin.index')->with('success1','Maire archivé avec succès.');
    // } catch (Exception $e) {
        // dd($e);
        // throw new Exception('error','Une erreur est survenue lors de la archivation mairie');
    // }
//  }
 public function agentdelete(Agent $agent){
    try {
        $agent->archive();
        return redirect()->route('agent.index')->with('success1','Agent supprimé avec succès.');
    } catch (Exception $e) {
        // dd($e);
        throw new Exception('error','Une erreur est survenue lors de la suppression Agent');
    }
 }

 public function defineAccess($email){
    //Vérification si le sous-admin existe déjà
    $checkSousadminExiste = Agent::where('email', $email)->first();

    if($checkSousadminExiste){
        return view('vendor.agent.auth.register', compact('email'));
    }else{
        return redirect()->route('doctor.login');
    };
}

public function submitDefineAccess(Request $request){

    // Validation des données
    $request->validate([
            'code'=>'required|exists:reset_code_password_agents,code',
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
        $agent = Agent::where('email', $request->email)->first();

        if ($agent) {
            // Mise à jour du mot de passe
            $agent->password = Hash::make($request->password);

            // Vérifier si une image est uploadée
            if ($request->hasFile('profile_picture')) {
                // Supprimer l'ancienne photo si elle existe
                if ($agent->profile_picture) {
                    Storage::delete('public/' . $agent->profile_picture);
                }

                // Stocker la nouvelle image
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $agent->profile_picture = $imagePath;
            }
            $agent->update();

            if($agent){
               $existingcodeagent =  ResetCodePasswordAgent::where('email', $agent->email)->count();

               if($existingcodeagent > 1){
                ResetCodePasswordAgent::where('email', $agent->email)->delete();
               }
            }

            return redirect()->route('agent.vue')->with('success', 'Compte mis à jour avec succès');
        } else {
            return redirect()->route('agent.vue')->with('error', 'Email inconnu');
        }
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}
public function agentdashboard(Agent $agent) {
    $alerts = Alert::all();
    return view('vendor.agent.dashboard', compact('agent','alerts'));
}


public function superindex() {
    $alerts = Alert::all();
    $agents = Agent::all();
    return view('vendor.agent.superindex', compact('agents','alerts'));
}



public function agentvue(Agent $agent, Request $request) {
    // Récupérer l'admin connecté
    $admin = Auth::guard('agent')->user();

    // Récupérer le mois et l'année sélectionnés
    $selectedMonth = $request->input('month', date('m'));
    $selectedYear = $request->input('year', date('Y'));
    $selectedMonthHops = $request->input('month_hops', date('m'));
    $selectedYearHops = $request->input('year_hops', date('Y'));

    // Récupérer les données associées à la commune de cet admin pour le mois sélectionné
    // Données pour naissances, décès, et mariages
    $naissances = Naissance::where('commune', $admin->communeM)
        ->where('is_read', false) // Filtrer pour les demandes non traitées
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    $naissancesD = NaissanceD::where('commune', $admin->communeM)
        ->where('is_read', false) // Filtrer pour les demandes non traitées
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    $deces = Deces::where('commune', $admin->communeM)
        ->where('is_read', false) // Filtrer pour les demandes non traitées
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    $decesdeja = Decesdeja::where('commune', $admin->communeM)
        ->where('is_read', false) // Filtrer pour les demandes non traitées
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    $mariages = Mariage::where('commune', $admin->communeM)
        ->where('is_read', false) // Filtrer pour les demandes non traitées
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    // Données pour naisshops et deceshops
    $naisshops = NaissHop::where('commune', $admin->communeM)
        ->whereMonth('created_at', $selectedMonthHops)
        ->whereYear('created_at', $selectedYearHops)
        ->orderBy('created_at', 'desc')
        ->get();

    $deceshops = DecesHop::where('commune', $admin->communeM)
        ->whereMonth('created_at', $selectedMonthHops)
        ->whereYear('created_at', $selectedYearHops)
        ->orderBy('created_at', 'desc')
        ->get();

    // Calcul des données globales
    $totalData = $naissances->count() + $naissancesD->count() + $deces->count()+ $decesdeja->count() + $mariages->count();
    $totalDataHops = $naisshops->count() + $deceshops->count();

    // Pourcentages
    $naissancePercentage = $totalData > 0 ? ($naissances->count() / $totalData) * 100 : 0;
    $naissanceDPercentage = $totalData > 0 ? ($naissancesD->count() / $totalData) * 100 : 0;
    $decesPercentage = $totalData > 0 ? ($deces->count() / $totalData) * 100 : 0;
    $decesdejaPercentage = $totalData > 0 ? ($decesdeja->count() / $totalData) * 100 : 0;
    $mariagePercentage = $totalData > 0 ? ($mariages->count() / $totalData) * 100 : 0;
    $naisshopPercentage = $totalDataHops > 0 ? ($naisshops->count() / $totalDataHops) * 100 : 0;
    $deceshopPercentage = $totalDataHops > 0 ? ($deceshops->count() / $totalDataHops) * 100 : 0;

    $Dece = $decesPercentage + $decesdejaPercentage;
    $NaissP = $naissancePercentage + $naissanceDPercentage;    
    $NaissHop = $naisshopPercentage + $deceshopPercentage; 

    // Données pour le tableau de bord
    $naissancedash = $naissances->count();
    $decesdash = $deces->count();
    $decesdejadash = $decesdeja->count();
    $mariagedash = $mariages->count();
    $naissanceDdash = $naissancesD->count();
    $naisshopsdash = $naisshops->count();
    $deceshopsdash = $deceshops->count();
    $Naiss = $naissancedash + $naissanceDdash;
    $NaissHopTotal = $naisshopsdash + $deceshopsdash;

    // Récupération des données récentes (2 derniers éléments)
    $recentNaissances = $naissances->take(2);
    $recentNaissancesd = $naissancesD->take(2); // Filtrer pour les récentes non traitées
    $recentDeces = $deces->take(2);
    $recentDecesdeja = $decesdeja->take(2);
    $recentMariages = $mariages->take(2);
    $recentNaisshops = $naisshops->take(2);
    $recentDeceshops = $deceshops->take(2);

    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces','decesdeja', 'decesHop', 'naissHop'])  
        ->latest()
        ->get();

    // Retourne la vue avec les données
    return view('vendor.agent.vue', compact(
        'naissancedash', 'naisshopsdash', 'deceshopsdash','decesdejadash', 
        'NaissHopTotal', 'decesdash', 'NaissP', 'mariagedash', 
        'naissances', 'naissancesD', 'deces','decesdeja', 'mariages', 
        'totalDataHops', 'totalData', 'naissancePercentage', 
        'naissanceDPercentage', 'decesPercentage','decesdejaPercentage', 'mariagePercentage', 
        'naisshopPercentage', 'deceshopPercentage', 
        'recentNaissances', 'recentNaissancesd', 'recentDeces','recentDecesdeja', 
        'recentMariages', 'alerts', 'Naiss','Dece', 'NaissHop', 
        'selectedMonth', 'selectedYear', 
        'selectedMonthHops', 'selectedYearHops', 'recentNaisshops', 'recentDeceshops'
    ));
}
}
