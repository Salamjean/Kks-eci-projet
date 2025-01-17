<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Ajoint;
use App\Models\Alert;
use App\Models\Caisse;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\DecesHop;
use App\Models\Doctor;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\NaissHop;
use App\Models\ResetCodePasswordMairie;
use App\Models\SousAdmin;
use App\Models\SuperAdmin;
use App\Models\Vendor;
use App\Notifications\SendEmailToMairieAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $alerts = Alert::all();
        $deces = Deces::count();
        $decesdeja = Decesdeja::count();
        $mariage = Mariage::count();
        $naissance = Naissance::count();
        $naissanceD = NaissanceD::count();
        $naisshop = NaissHop::count();
        $deceshop = DecesHop::count();
        $agents = Agent::count();
        $caisses = Caisse::count();
        $doctors = Doctor::count();
        $ajoints = Ajoint::count();
        $mairie = Vendor::whereNull('archived_at')->count();
        $sousadmin = SousAdmin::count();
        $total = $deces + $decesdeja + $mariage + $naissance + $naissanceD;
        // Solde initial
        $soldeActuel = 300000 * $mairie;
        // Déduction pour chaque nouvelle demande
        $debit = 500; // Montant à déduire pour chaque demande
        $soldeDebite = $total * $debit; // Total débité basé sur le nombre de demandes
        $soldeRestant = $soldeActuel - $soldeDebite; // Calcul du solde restant
        return view('superadmin.dashboard',compact('alerts','deces','decesdeja','mariage','naissance',
        'naissanceD','total','soldeActuel','soldeDebite','soldeRestant','deceshop','naisshop',
        'agents','caisses','doctors','mairie','ajoints','sousadmin'));
    }

    public function logout()
    {
        Auth::guard('super_admin')->logout();
        return redirect()->route('super_admin.login');
    }


    public function index()
{
    // Récupérer uniquement les mairies non archivées
    $vendors = Vendor::whereNull('archived_at')->get();

    // Compter les agents par commune
    $agentsCountByCommune = Agent::select('communeM', DB::raw('count(*) as total'))
        ->groupBy('communeM')
        ->get();
    $agentsCount = [];
    foreach ($agentsCountByCommune as $item) {
        $agentsCount[$item->communeM] = $item->total;
    }

    // Compter les caisses par commune
    $caisseCountByCommune = Caisse::select('communeM', DB::raw('count(*) as total'))
        ->groupBy('communeM')
        ->get();
    $caisseCount = [];
    foreach ($caisseCountByCommune as $item) {
        $caisseCount[$item->communeM] = $item->total;
    }

    // Compter les hôpitaux par commune
    $doctorCountByCommune = Doctor::select('commune', DB::raw('count(*) as total'))
        ->groupBy('commune')
        ->get();
    $doctorCount = [];
    foreach ($doctorCountByCommune as $item) {
        $doctorCount[$item->commune] = $item->total;
    }

    $ajointCountByCommune = Ajoint::select('communeM', DB::raw('count(*) as total'))
        ->groupBy('communeM')
        ->get();
    $ajointCount = [];
    foreach ($ajointCountByCommune as $item) {
        $ajointCount[$item->communeM] = $item->total;
    }

    // Compter les demandes par commune
    $naissanceCountByCommune = Naissance::select('commune', DB::raw('count(*) as total'))
        ->groupBy('commune')
        ->get();
    $naissanceCount = [];
    foreach ($naissanceCountByCommune as $item) {
        $naissanceCount[$item->commune] = $item->total;
    }

    $naissanceDCountByCommune = NaissanceD::select('commune', DB::raw('count(*) as total'))
        ->groupBy('commune')
        ->get();
    $naissanceDCount = [];
    foreach ($naissanceDCountByCommune as $item) {
        $naissanceDCount[$item->commune] = $item->total;
    }

    $decesCountByCommune = Deces::select('commune', DB::raw('count(*) as total'))
        ->groupBy('commune')
        ->get();
    $decesCount = [];
    foreach ($decesCountByCommune as $item) {
        $decesCount[$item->commune] = $item->total;
    }

    $decesdejaCountByCommune = Decesdeja::select('commune', DB::raw('count(*) as total'))
        ->groupBy('commune')
        ->get();
    $decesdejaCount = [];
    foreach ($decesdejaCountByCommune as $item) {
        $decesdejaCount[$item->commune] = $item->total;
    }

    $mariageCountByCommune = Mariage::select('commune', DB::raw('count(*) as total'))
        ->groupBy('commune')
        ->get();
    $mariageCount = [];
    foreach ($mariageCountByCommune as $item) {
        $mariageCount[$item->commune] = $item->total;
    }

    // Calculer le solde restant par commune
    $soldeRestantParCommune = [];
    $soldeActuel = 300000; // Solde actuel
    $debit = 500; // Montant à déduire pour chaque demande

    foreach ($vendors as $vendor) {
        // Compter les demandes pour cette commune
        $totalDemandesCount = (
            ($naissanceCount[$vendor->name] ?? 0) +
            ($naissanceDCount[$vendor->name] ?? 0) +
            ($decesCount[$vendor->name] ?? 0) +
            ($decesdejaCount[$vendor->name] ?? 0) +
            ($mariageCount[$vendor->name] ?? 0)
        );

        // Calculer le solde restant pour cette commune
        $soldeDebite = $totalDemandesCount * $debit;
        $soldeRestant = $soldeActuel - $soldeDebite;

        // Stocker dans le tableau associatif
        $soldeRestantParCommune[$vendor->name] = $soldeRestant;
    }

    return view('superadmin.mairie.index', compact('vendors', 'agentsCount', 'caisseCount', 'doctorCount', 'ajointCount', 'soldeRestantParCommune'));
}

    public function register(){
        return view('superadmin.auth.register');
    }

    public function login(){
        return view('superadmin.auth.login');
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
            SuperAdmin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            // Redirection avec un message de succès
            return redirect()->route('super_admin.login')->with('success', 'Votre compte a été créé avec succès. Vous pouvez vous connecter.');
        } catch (Exception $e) {
            // En cas d'erreur inattendue
            return back()->withErrors(['error' => 'Une erreur est survenue. Veuillez réessayer.'])->withInput();
        }
    }

    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' =>'required|exists:super_admins,email',
            'password' => 'required|min:8',
        ], [
            
            
            'email.required' => 'Le mail est obligatoire.',
            'email.exists' => 'Cette adresse mail n\'existe pas.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min'=> 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);
        try {
            if(auth('super_admin')->attempt($request->only('email', 'password')))
            {
                return redirect()->route('super_admin.dashboard')->with('Bienvenu sur votre page ');
            }else{
                return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function create(){
        $alerts = Alert::all();
        $admin = Auth::guard('super_admin')->user();
        $vendor = Vendor::all();
        return view('superadmin.mairie.create', compact('alerts','vendor'));
    }

    public function store(Request $request)
{
    // Validation des données
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:doctors,email',
    ]);

    try {
        // Récupérer le vendor connecté
        $vendor = Auth::guard('super_admin')->user();

        if (!$vendor) {
            return redirect()->back()->withErrors(['error' => 'Impossible de récupérer les informations du vendor.']);
        }

        // Création du docteur
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->password = Hash::make('password');
        $vendor->save();

        // Envoi de l'e-mail de vérification
        ResetCodePasswordMairie::where('email', $vendor->email)->delete();
        $code = rand(10000, 40000);

        ResetCodePasswordMairie::create([
            'code' => $code,
            'email' => $vendor->email,
        ]);

        Notification::route('mail', $vendor->email)
            ->notify(new SendEmailToMairieAfterRegistrationNotification($code, $vendor->email));

        return redirect()->route('super_admin.index')
            ->with('success', 'Mairie enregistré avec succès.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
    }
}

public function defineAccess($email){
    //Vérification si le sous-admin existe déjà
    $checkSousadminExiste = Vendor::where('email', $email)->first();

    if($checkSousadminExiste){
        return view('vendor.auth.register', compact('email'));
    }else{
        return redirect()->route('vendor.login');
    };
}

public function submitDefineAccess(Request $request){

    // Validation des données
    $request->validate([
            'code'=>'required|exists:reset_code_password_mairies,code',
            'password' => 'required|same:confirme_password',
            'confirme_password' => 'required|same:password',
        ], [
            'code.exists' => 'Le code de réinitialisation est invalide.',
            'password.same' => 'Les mots de passe doivent être identiques.',
            'confirme_password.same' => 'Les mots de passe doivent être identiques.',
    ]);
    try {
        $vendor = Vendor::where('email', $request->email)->first();

        if ($vendor) {
            // Mise à jour du mot de passe
            $vendor->password = Hash::make($request->password);
            $vendor->update();

            if($vendor){
               $existingcodehop =  ResetCodePasswordMairie::where('email', $vendor->email)->count();

               if($existingcodehop > 1){
                ResetCodePasswordMairie::where('email', $vendor->email)->delete();
               }
            }

            return redirect()->route('vendor.login')->with('success', 'Compte mis à jour avec succès');
        } else {
            return redirect()->route('vendor.login')->with('error', 'Email inconnu');
        }
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

public function archive(){
     // Récupérer uniquement les mairies non archivées
 $vendors = Vendor::whereNotNull('archived_at')->get();
 // Compter les agents par commune
 $agentsCountByCommune = Agent::select('communeM', DB::raw('count(*) as total'))
     ->groupBy('communeM')
     ->get();
 $agentsCount = [];
 foreach ($agentsCountByCommune as $item) {
     $agentsCount[$item->communeM] = $item->total;
 }
 // Compter les caisses par commune
 $caisseCountByCommune = Caisse::select('communeM', DB::raw('count(*) as total'))
     ->groupBy('communeM')
     ->get();
 $caisseCount = [];
 foreach ($caisseCountByCommune as $item) {
     $caisseCount[$item->communeM] = $item->total;
 }
 // Compter les hôpitaux par commune
 $doctorCountByCommune = Doctor::select('commune', DB::raw('count(*) as total'))
     ->groupBy('commune')
     ->get();
 $doctorCount = [];
 foreach ($doctorCountByCommune as $item) {
     $doctorCount[$item->commune] = $item->total;
 }
 $ajointCountByCommune = Ajoint::select('communeM', DB::raw('count(*) as total'))
     ->groupBy('communeM')
     ->get();
 $ajointCount = [];
 foreach ($ajointCountByCommune as $item) {
     $ajointCount[$item->communeM] = $item->total;
 }
 // Compter les demandes par commune
 $naissanceCountByCommune = Naissance::select('commune', DB::raw('count(*) as total'))
     ->groupBy('commune')
     ->get();
 $naissanceCount = [];
 foreach ($naissanceCountByCommune as $item) {
     $naissanceCount[$item->commune] = $item->total;
 }
 $naissanceDCountByCommune = NaissanceD::select('commune', DB::raw('count(*) as total'))
     ->groupBy('commune')
     ->get();
 $naissanceDCount = [];
 foreach ($naissanceDCountByCommune as $item) {
     $naissanceDCount[$item->commune] = $item->total;
 }
 $decesCountByCommune = Deces::select('commune', DB::raw('count(*) as total'))
     ->groupBy('commune')
     ->get();
 $decesCount = [];
 foreach ($decesCountByCommune as $item) {
     $decesCount[$item->commune] = $item->total;
 }
 $decesdejaCountByCommune = Decesdeja::select('commune', DB::raw('count(*) as total'))
     ->groupBy('commune')
     ->get();
 $decesdejaCount = [];
 foreach ($decesdejaCountByCommune as $item) {
     $decesdejaCount[$item->commune] = $item->total;
 }
 $mariageCountByCommune = Mariage::select('commune', DB::raw('count(*) as total'))
     ->groupBy('commune')
     ->get();
 $mariageCount = [];
 foreach ($mariageCountByCommune as $item) {
     $mariageCount[$item->commune] = $item->total;
 }
 // Calculer le solde restant par commune
 $soldeRestantParCommune = [];
 $soldeActuel = 300000; // Solde actuel
 $debit = 500; // Montant à déduire pour chaque demande
 foreach ($vendors as $vendor) {
     // Compter les demandes pour cette commune
     $totalDemandesCount = (
         ($naissanceCount[$vendor->name] ?? 0) +
         ($naissanceDCount[$vendor->name] ?? 0) +
         ($decesCount[$vendor->name] ?? 0) +
         ($decesdejaCount[$vendor->name] ?? 0) +
         ($mariageCount[$vendor->name] ?? 0)
     );
     // Calculer le solde restant pour cette commune
     $soldeDebite = $totalDemandesCount * $debit;
     $soldeRestant = $soldeActuel - $soldeDebite;
     // Stocker dans le tableau associatif
     $soldeRestantParCommune[$vendor->name] = $soldeRestant;
 }
 return view('superadmin.mairie.archive', compact('vendors', 'agentsCount', 'caisseCount', 'doctorCount', 'ajointCount', 'soldeRestantParCommune'));
}

}
