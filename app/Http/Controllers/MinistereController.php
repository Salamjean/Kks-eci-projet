<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\DecesHop;
use App\Models\Ministere;
use App\Models\MinistereAgent;
use App\Models\ResetCodePasswordMinistere;
use App\Notifications\SendEmailToMinistereAfterRegistrationNotification;
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
        // Récupérer le terme de recherche depuis la requête
        $searchTerm = $request->input('search');
    
        // Vérifier si un terme de recherche est présent
        $hasSearchTerm = !empty($searchTerm);
    
        // Initialiser la variable pour stocker les résultats
        $defunts = [];
    
        // Si un terme de recherche est présent, effectuer la recherche
        if ($hasSearchTerm) {
            $defunts = DecesHop::where('NomM', 'like', '%' . $searchTerm . '%')
                ->orWhere('PrM', 'like', '%' . $searchTerm . '%')
                ->orWhere('codeCMD', 'like', '%' . $searchTerm . '%')
                ->get();
        }
    
        // Déterminer si des résultats ont été trouvés
        $found = $hasSearchTerm && !empty($defunts) && $defunts->count() > 0;
    
        // Retourner la vue avec les résultats de la recherche
        return view('superadmin.ministere.dashboard', compact('defunts', 'searchTerm', 'found', 'hasSearchTerm'));
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
