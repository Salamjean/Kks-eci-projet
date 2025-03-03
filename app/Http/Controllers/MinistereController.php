<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\DecesHop;
use App\Models\Ministere;
use App\Models\MinistereAgent;
use App\Models\MinistereSearchHistory;
use App\Models\NaissHop;
use App\Models\ResetCodePasswordMinistere;
use App\Notifications\SendEmailToMinistereAfterRegistrationNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class MinistereController extends Controller
{
    public function dashboard(Request $request)
    {
        $admin = Auth::guard('ministere')->user();
        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);
    
        // Compter le nombre total de déclarations de naissances et de décès
        $deceshops = DecesHop::count();
        $naisshops = NaissHop::count();
        
    
        // Récupérer les données pour les graphiques (Naissances)
        $naissData = NaissHop::whereYear('created_at', $selectedYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();
    
        // Remplir les données manquantes pour les naissances
        $naissData = array_replace(array_fill(1, 12, 0), $naissData);
    
        // Récupérer les données pour les graphiques (Décès)
        $decesData = DecesHop::whereYear('created_at', $selectedYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();
    
        // Remplir les données manquantes pour les décès
        $decesData = array_replace(array_fill(1, 12, 0), $decesData);
    
        // Compter les déclarations de naissances par commune et par mois
        $naissByCommunePerMonth = NaissHop::whereYear('created_at', $selectedYear)
            ->selectRaw('MONTH(created_at) as month, commune, COUNT(*) as total')
            ->groupBy('month', 'commune')
            ->orderBy('month')
            ->orderByDesc('total')
            ->get()
            ->groupBy('month');
    
        // Compter les déclarations de décès par commune et par mois
        $decesByCommunePerMonth = DecesHop::whereYear('created_at', $selectedYear)
            ->selectRaw('MONTH(created_at) as month, commune, COUNT(*) as total')
            ->groupBy('month', 'commune')
            ->orderBy('month')
            ->orderByDesc('total')
            ->get()
            ->groupBy('month');
    
        // Récupérer l'historique des recherches depuis la session avec une clé spécifique au ministère
        $searchHistory = session('ministere_search_history', []);
    
        // Compter les agents du ministère
        $ministereagent = MinistereAgent::where('communeM', $admin->siege)->count();
    
        return view('superadmin.ministere.dashboard', compact(
            'ministereagent',
            'naissData',
            'decesData',
            'deceshops',
            'naisshops',
            'searchHistory',
            'naissByCommunePerMonth',
            'decesByCommunePerMonth',
            'selectedYear',
            'selectedMonth',
        ));
    }  
public function historique(){
    $rechercheInfo = MinistereSearchHistory::latest()->paginate(10);
    return view('superadmin.ministere.historique', compact('rechercheInfo'));
}

function decesclaration(){
    $deceshops = DecesHop::all();
    return view('superadmin.ministere.decesindex', compact('deceshops'));
}
function naissancedeclaration(){
    $naisshops = NaissHop::with('enfants')->get();
    return view('superadmin.ministere.naissindex', compact('naisshops'));
}
    public function create(){
        $alerts = Alert::all();
        $admin = Auth::guard('super_admin')->user();
        return view('superadmin.ministere.create', compact('alerts'));
    }
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'siege' => 'required|unique:ministeres,siege',
            'email' => 'required|email|unique:ministeres,email',
        ],[
            'siege.unique' => 'Cet siège du ministere de la santé existe déjà verifier dans l\'archive',
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
            $ministere = new Ministere();
            $ministere->name = $request->name;
            $ministere->siege = $request->siege;
            $ministere->email = $request->email;
            $ministere->password = Hash::make('password');
            $ministere->save();
    
            // Envoi de l'e-mail de vérification
            ResetCodePasswordMinistere::where('email', $ministere->email)->delete();
            $code = rand(10000, 40000);
    
            ResetCodePasswordMinistere::create([
                'code' => $code,
                'email' => $ministere->email,
            ]);
    
            Notification::route('mail', $ministere->email)
                ->notify(new SendEmailToMinistereAfterRegistrationNotification($code, $ministere->email));
    
            return redirect()->route('ministere.index')
                ->with('success', 'Le ministère de la santé est enregistré avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        // Récupérer uniquement les mairies non archivées
        $ministeres = Ministere::whereNull('archived_at')->get();

        // Compter les agents par commune
        $agentsCountByCommune = MinistereAgent::select('communeM', DB::raw('count(*) as total'))
        ->groupBy('communeM')
        ->get();
    $agentsCount = [];
    foreach ($agentsCountByCommune as $item) {
        $agentsCount[$item->communeM] = $item->total;
    }

        return view('superadmin.ministere.index', compact('ministeres','agentsCount'));
    }

    public function ministerearchive(Ministere $ministere){
        try {
            $ministere->archive();
            return redirect()->route('ministere.indexarchive')->with('success1','Ministère de la santé archivé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la archivation CGRAE');
        }
     }

     public function archive(){
        // Récupérer uniquement les mairies non archivées
        $ministeres = Ministere::whereNotNull('archived_at')->get();
        // Compter les agents par commune
        // $agentsCountByCommune = Agent::select('communeM', DB::raw('count(*) as total'))
            // ->groupBy('communeM')
            // ->get();
        // $agentsCount = [];
        // foreach ($agentsCountByCommune as $item) {
            // $agentsCount[$item->communeM] = $item->total;
        // }
        // Calculer le solde total restant après toutes les déductions
        
    return view('superadmin.ministere.archive', compact('ministeres'));
   }

   public function unarchive($id)
   {
       $ministeres = Ministere::find($id);
      
       if ($ministeres && $ministeres->archived_at) {
           $ministeres->archived_at = null;
           $ministeres->save();
      
           return redirect()->route('ministere.index')->with('success', 'L\'élément a été désarchivé avec succès.');
       }
      
       // Si l'élément n'existe pas ou n'est pas archivé, rediriger avec un message d'erreur
       return redirect()->back()->with('error', 'L\'élément n\'a pas pu être désarchivé.');
   }

   public function ministeredelete(Ministere $ministere){
    try {
        $ministere->delete();
        return redirect()->route('ministere.indexarchive')->with('success1','ministère de la santé supprimée avec succès.');
    } catch (Exception $e) {
        // dd($e);
        throw new Exception('error','Une erreur est survenue lors de la suppression du ministère ');
    }
 }

 public function register(){
    return view('superadmin.ministere.auth.validate');
}

public function login(){
    return view('superadmin.ministere.auth.login');
}


public function handleLogin(Request $request)
{
    $request->validate([
        'email' =>'required|exists:ministeres,email',
        'password' => 'required|min:8',
    ], [
        
        
        'email.required' => 'Le mail est obligatoire.',
        'email.exists' => 'Cette adresse mail n\'existe pas.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min'=> 'Le mot de passe doit avoir au moins 8 caractères.',
    ]);
    try {
        if(auth('ministere')->attempt($request->only('email', 'password')))
        {
            return redirect()->route('ministere.dashboard')->with('Bienvenu sur votre page ');
        }else{
            return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
        }
    } catch (Exception $e) {
        dd($e);
    }
}

public function logout(){
    Auth::guard('ministere')->logout();
    return redirect()->route('ministere.login');
}

public function defineAccess($email){
    //Vérification si le sous-admin existe déjà
    $checkSousadminExiste = Ministere::where('email', $email)->first();

    if($checkSousadminExiste){
        return view('superadmin.ministere.auth.validate', compact('email'));
    }else{
        return redirect()->route('ministere.login');
    };
}

public function submitDefineAccess(Request $request){

    // Validation des données
    $request->validate([
            'code'=>'required|exists:reset_code_password_ministeres,code',
            'password' => 'required|same:confirme_password',
            'confirme_password' => 'required|same:password',
        ], [
            'code.exists' => 'Le code de réinitialisation est invalide.',
            'password.same' => 'Les mots de passe doivent être identiques.',
            'confirme_password.same' => 'Les mots de passe doivent être identiques.',
    ]);
    try {
        $ministere = Ministere::where('email', $request->email)->first();

        if ($ministere) {
            // Mise à jour du mot de passe
            $ministere->password = Hash::make($request->password);
            $ministere->update();

            if($ministere){
               $existingcodehop =  ResetCodePasswordMinistere::where('email', $ministere->email)->count();

               if($existingcodehop > 1){
                ResetCodePasswordMinistere::where('email', $ministere->email)->delete();
               }
            }

            return redirect()->route('ministere.login')->with('success', 'Compte mis à jour avec succès');
        } else {
            return redirect()->route('ministere.login')->with('error', 'Email inconnu');
        }
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

   
}
