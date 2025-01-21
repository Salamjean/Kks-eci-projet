<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAgentRequest;
use App\Models\Alert;
use App\Models\CgraeAgent;
use App\Models\DecesHop;
use App\Models\ResetCodePasswordCgraeAgent;
use App\Notifications\SendEmailToCgraeAgentAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class CgraeAgentController extends Controller
{
        public function create(){
            $alerts = Alert::all();
            return view('superadmin.cgrae.agent.create', compact('alerts'));
         }
         public function store(Request $request){
            // Validation des données
           
            $request->validate([
               'name' => 'required|string|max:255',
               'prenom' => 'required|string|max:255',
               'email' => 'required|email|unique:cgrae_agents,email',
               'contact' => 'required|string|min:10',
               'commune' => 'required|string|max:255',
               'profile_picture' => 'nullable|image|max:2048',
           
           ]);
           try {
               // Récupérer le vendor connecté
               $cgrae = Auth::guard('cgrae')->user();
               if (!$cgrae || !$cgrae->siege) {
                   return redirect()->back()->withErrors(['error' => 'Impossible de récupérer les informations du vendor.']);
               }
               // Création du docteur
               $agent = new CgraeAgent();
               $agent->name = $request->name;
               $agent->prenom = $request->prenom;
               $agent->email = $request->email;
               $agent->contact = $request->contact;
               $agent->password = Hash::make('default');
               
               if ($request->hasFile('profile_picture')) {
                   $agent->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
               }
               $agent->commune = $request->commune;
               $agent->communeM = $cgrae->siege;
               
               $agent->save();
               // Envoi de l'e-mail de vérification
               ResetCodePasswordCgraeAgent::where('email', $agent->email)->delete();
               $code = rand(100000, 400000);
               ResetCodePasswordCgraeAgent::create([
                   'code' => $code,
                   'email' => $agent->email,
               ]);
               Notification::route('mail', $agent->email)
                   ->notify(new SendEmailToCgraeAgentAfterRegistrationNotification($code, $agent->email));
               return redirect()->route('cgraeagent.index')->with('success', 'Agent enregistré avec succès.');
           } catch (\Exception $e) {
               return redirect()->back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
           }
        }

        public function index()
        {
            $admin = Auth::guard('cgrae')->user();
        
            $alerts = Alert::all();
            $agents = CgraeAgent::whereNull('archived_at')
                ->where('communeM', $admin->siege)
                ->paginate(10);
        
            // Retourner la vue avec les données
            return view('superadmin.cgrae.agent.index', compact('agents', 'alerts'));
        }

        public function edit(CgraeAgent $agent){
            $alerts = Alert::all();
            return view('superadmin.cgrae.agent.edit', compact('agent','alerts'));
         }

         public function update(UpdateAgentRequest $request ,CgraeAgent $agent){
            try {
                $agent->name = $request->name;
                $agent->prenom = $request->prenom;
                $agent->email = $request->email;
                $agent->contact = $request->contact;
                $agent->commune = $request->commune;
                $agent->update();
                return redirect()->route('cgraeagent.index')->with('success','Les informations agent mises à jour avec succès.');
            } catch (Exception $e) {
                // dd($e);
                throw new Exception('error','Une erreur est survenue lors de la modification de l\'agent de la cnps');
            }
         }

         public function archive(CgraeAgent $agent){
            try {
                $agent->archive();
                return redirect()->route('cgraeagent.index')->with('success1','Agent archivé avec succès.');
            } catch (Exception $e) {
                dd($e);
                throw new Exception('error','Une erreur est survenue lors de la archivation agent');
            }
         }


         public function defineAccess($email){
            //Vérification si le l'agent existe déjà
            $checkSousadminExiste = CgraeAgent::where('email', $email)->first();
            if($checkSousadminExiste){
                return view('superadmin.cgrae.agent.auth.validate', compact('email'));
            }else{
                return redirect()->route('cgraeagent.login');
            };
        }
    
    public function submitDefineAccess(Request $request){
    
            // Validation des données
            $request->validate([
                    'code'=>'required|exists:reset_code_password_cgrae_agents,code',
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
                $agent = CgraeAgent::where('email', $request->email)->first();
        
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
                       $existingcodeagent =  ResetCodePasswordCgraeAgent::where('email', $agent->email)->count();
        
                       if($existingcodeagent > 1){
                        ResetCodePasswordCgraeAgent::where('email', $agent->email)->delete();
                       }
                    }
        
                    return redirect()->route('cgraeagent.dashboard')->with('success', 'Compte mis à jour avec succès');
                } else {
                    return redirect()->route('cgraeagent.dashboard')->with('error', 'Email inconnu');
                }
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
            }
        }


        public function dashboard(Request $request){
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
                $alerts = Alert::all();
        return view('superadmin.cgrae.agent.dashboard', compact('alerts','defunts', 'searchTerm', 'found', 'hasSearchTerm'));
    }
    public function logout(){
        Auth::guard('cgraeagent')->logout();
        return redirect()->route('cgraeagent.login');
    }
    public function login(){
        return view('superadmin.cgrae.agent.auth.login');
    }
    
    public function handleLogin(Request $request)
    {
        // Validation des champs du formulaire
        $request->validate([
            'email' => 'required|exists:cgrae_agents,email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Le mail est obligatoire.',
            'email.exists' => 'Cette adresse mail n\'existe pas.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
        ]);
    
        try {
            // Récupérer l'agent par son email
            $agent = CgraeAgent::where('email', $request->email)->first();
    
            // Vérifier si l'agent est archivé
            if ($agent && $agent->archived_at !== null) {
                return redirect()->back()->with('error', 'Votre compte a été supprimé. Vous ne pouvez pas vous connecter.');
            }
    
            // Tenter la connexion
            if (auth('cgraeagent')->attempt($request->only('email', 'password'))) {
                return redirect()->route('cgraeagent.dashboard')->with('success', 'Bienvenue sur votre page.');
            } else {
                return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
            }
        } catch (Exception $e) {
            // Gérer les erreurs
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la connexion.');
        }
    }
}
