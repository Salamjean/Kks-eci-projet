<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Cnps;
use App\Models\CnpsAgent;
use App\Models\Decesdeja;
use App\Models\DecesHop;
use App\Models\ResetCodePasswordCnps;
use App\Notifications\SendEmailToAgentAfterRegistrationNotification;
use App\Notifications\SendEmailToCnpsAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class CnpsController extends Controller
{

    public function dashboard(Request $request)
{
    $admin = Auth::guard('cnps')->user();
    $cnpsagent = CnpsAgent::where('communeM', $admin->siege)->count();
    $deceshops = DecesHop::count();

    // Récupérer l'historique des recherches depuis la session avec une clé spécifique à la CNPS
    $searchHistory = session('cnps_search_history', []);
    $searchHistory = array_slice($searchHistory, -5);

    return view('superadmin.cnps.dashboard', compact(
        'cnpsagent',
        'deceshops',
        'searchHistory'
    ));
}

public function recherche(Request $request)
{
    $admin = Auth::guard('cnps')->user();
    $cnpsagent = CnpsAgent::where('communeM', $admin->siege)->count();
    $deceshops = DecesHop::count();
    // Récupérer l'historique des recherches depuis la session avec une clé spécifique à la CNPS
    $searchHistory = session('cnps_search_history', []);

    return view('superadmin.cnps.recherche', compact(
        'cnpsagent',
        'deceshops',
        'searchHistory'
    ));
}
    function indexdeclaration(){
        $deceshops = DecesHop::all();
        return view('superadmin.cnps.cnpsindex', compact('deceshops'));
    }

    public function create(){
        $alerts = Alert::all();
        $admin = Auth::guard('super_admin')->user();
        return view('superadmin.cnps.create', compact('alerts'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'siege' => 'required|unique:cnps,siege',
            'email' => 'required|email|unique:cnps,email',
        ],[
            'siege.unique' => 'Cet siège de la cnps existe déjà verifier dans l\'archive',
            'siege.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail existe déjà.',
        ]);
    
        try {
            // Récupérer le vendor connecté
            $vendor = Auth::guard('super_admin')->user();
    
            if (!$vendor) {
                return redirect()->back()->withErrors(['error' => 'Impossible de récupérer les informations du vendor.']);
            }
    
            // Création du docteur
            $cnps = new Cnps();
            $cnps->name = $request->name;
            $cnps->siege = $request->siege;
            $cnps->email = $request->email;
            $cnps->password = Hash::make('password');
            $cnps->save();
    
            // Envoi de l'e-mail de vérification
            ResetCodePasswordCnps::where('email', $cnps->email)->delete();
            $code = rand(10000, 40000);
    
            ResetCodePasswordCnps::create([
                'code' => $code,
                'email' => $cnps->email,
            ]);
    
            Notification::route('mail', $cnps->email)
                ->notify(new SendEmailToCnpsAfterRegistrationNotification($code, $cnps->email));
    
            return redirect()->route('cnps.index')
                ->with('success', 'CNPS enregistré avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        // Récupérer uniquement les mairies non archivées
        $cnps = Cnps::whereNull('archived_at')->get();
    
        // Compter les agents par commune
        $agentsCountByCommune = CnpsAgent::select('communeM', DB::raw('count(*) as total'))
            ->groupBy('communeM')
            ->get();
        $agentsCount = [];
        foreach ($agentsCountByCommune as $item) {
            $agentsCount[$item->communeM] = $item->total;
        }
    
        return view('superadmin.cnps.index', compact('cnps', 'agentsCount'));
    }

    public function cnpsarchive(Cnps $cnps){
        try {
            $cnps->archive();
            return redirect()->route('cnps.indexarchive')->with('success1','CNPS archivé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la archivation CNPS');
        }
     }


     public function archive(){
        // Récupérer uniquement les mairies non archivées
    $cnps = Cnps::whereNotNull('archived_at')->get();

    // Compter les agents par commune
    // $agentsCountByCommune = Agent::select('communeM', DB::raw('count(*) as total'))
        // ->groupBy('communeM')
        // ->get();
    // $agentsCount = [];
    // foreach ($agentsCountByCommune as $item) {
        // $agentsCount[$item->communeM] = $item->total;
    // }
   // Calculer le solde total restant après toutes les déductions
   
    return view('superadmin.cnps.archive', compact('cnps'));
   }


   public function unarchive($id)
   {
       $cnps = Cnps::find($id);
   
       if ($cnps && $cnps->archived_at) {
           $cnps->archived_at = null;
           $cnps->save();
   
           return redirect()->route('cnps.index')->with('success', 'L\'élément a été désarchivé avec succès.');
       }
   
       // Si l'élément n'existe pas ou n'est pas archivé, rediriger avec un message d'erreur
       return redirect()->back()->with('error', 'L\'élément n\'a pas pu être désarchivé.');
   }


   public function cnpsdelete(Cnps $Cnps){
    try {
        $Cnps->delete();
        return redirect()->route('cnps.indexarchive')->with('success1','CNPS supprimée avec succès.');
    } catch (Exception $e) {
        // dd($e);
        throw new Exception('error','Une erreur est survenue lors de la suppression CNPS');
    }
 }

 public function register(){
    return view('superadmin.cnps.auth.validate');
}

public function login(){
    return view('superadmin.cnps.auth.login');
}


public function handleLogin(Request $request)
{
    $request->validate([
        'email' =>'required|exists:cnps,email',
        'password' => 'required|min:8',
    ], [
        
        
        'email.required' => 'Le mail est obligatoire.',
        'email.exists' => 'Cette adresse mail n\'existe pas.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min'=> 'Le mot de passe doit avoir au moins 8 caractères.',
    ]);
    try {
        if(auth('cnps')->attempt($request->only('email', 'password')))
        {
            return redirect()->route('cnps.dashboard')->with('Bienvenu sur votre page ');
        }else{
            return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
        }
    } catch (Exception $e) {
        dd($e);
    }
}

 // definissons les acces de la cnps 

 public function defineAccess($email){
    //Vérification si le sous-admin existe déjà
    $checkSousadminExiste = Cnps::where('email', $email)->first();

    if($checkSousadminExiste){
        return view('superadmin.cnps.auth.validate', compact('email'));
    }else{
        return redirect()->route('cnps.login');
    };
}

public function submitDefineAccess(Request $request){

    // Validation des données
    $request->validate([
            'code'=>'required|exists:reset_code_password_cnps,code',
            'password' => 'required|same:confirme_password',
            'confirme_password' => 'required|same:password',
        ], [
            'code.exists' => 'Le code de réinitialisation est invalide.',
            'password.same' => 'Les mots de passe doivent être identiques.',
            'confirme_password.same' => 'Les mots de passe doivent être identiques.',
    ]);
    try {
        $cnps = Cnps::where('email', $request->email)->first();

        if ($cnps) {
            // Mise à jour du mot de passe
            $cnps->password = Hash::make($request->password);
            $cnps->update();

            if($cnps){
               $existingcodehop =  ResetCodePasswordCnps::where('email', $cnps->email)->count();

               if($existingcodehop > 1){
                ResetCodePasswordCnps::where('email', $cnps->email)->delete();
               }
            }

            return redirect()->route('cnps.login')->with('success', 'Compte mis à jour avec succès');
        } else {
            return redirect()->route('cnps.login')->with('error', 'Email inconnu');
        }
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

public function logout(){
    Auth::guard('cnps')->logout();
    return redirect()->route('cnps.login');
}

}
