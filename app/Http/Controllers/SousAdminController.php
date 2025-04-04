<?php

namespace App\Http\Controllers;

use App\Http\Requests\SousAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\updateDoctorRequest;
use App\Http\Requests\UpdateSignatureRequest;
use App\Models\Alert;
use App\Models\DecesHop;
use App\Models\NaissHop;
use App\Models\ResetCodePassword;
use App\Models\SousAdmin;
use App\Notifications\SendEmailToDoctorAfterRegistrationNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class SousAdminController extends Controller
{

    public function dashboard(Request $request)
{
    try {
        $sousadmin = Auth::guard('sous_admin')->user();
        $communeAdmin = $sousadmin->nomHop;
        $sousAdminId = $sousadmin->id; // Récupérer l'ID du sous-administrateur

        // Récupérer les déclarations de naissances du jour en cours
        $declarationsRecents = NaissHop::where('NomEnf', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->whereDate('created_at', now()->format('Y-m-d')) // Filtrer par date
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Récupérer les déclarations de décès du jour en cours
        $decesRecents = DecesHop::where('nomHop', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->whereDate('created_at', now()->format('Y-m-d')) // Filtrer par date
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Compter les déclarations par mois
        $naisshopData = NaissHop::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as count'))
            ->where('NomEnf', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $deceshopData = DecesHop::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('count(*) as count'))
            ->where('nomHop', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        // Récupérer le mois et l'année sélectionnés
        $selectedMonth = $request->input('month', date('m'));
        $selectedYear = $request->input('year', date('Y'));

        // Compter le total des déclarations de naissance et de décès pour le mois sélectionné
        $naisshop = NaissHop::where('NomEnf', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        $deceshop = DecesHop::where('nomHop', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->count();

        // Récupérer les données pour les graphiques (Naissances)
        $naissData = NaissHop::where('NomEnf', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->whereYear('created_at', $selectedYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Remplir les données manquantes pour les naissances
        $naissData = array_replace(array_fill(1, 12, 0), $naissData);

        // Calculer le total des déclarations
        $total = $naisshop + $deceshop;

        // Récupérer les données pour les graphiques (Décès)
        $decesData = DecesHop::where('nomHop', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->whereYear('created_at', $selectedYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Remplir les données manquantes pour les décès
        $decesData = array_replace(array_fill(1, 12, 0), $decesData);

        // Passer les données à la vue
        return view('sous_admin.dashboard', compact(
            'naisshop',
            'deceshop',
            'total',
            'selectedMonth',
            'selectedYear',
            'naissData',
            'decesData',
            'declarationsRecents',
            'decesRecents'
        ));
    } catch (Exception $e) {
        // Gérer les erreurs
        return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la récupération des données.');
    }
}
    
    public function souslogout(){
        Auth::guard('sous_admin')->logout();
        return redirect()->route('sous_admin.login');
    }
    
    
    public function edit(SousAdmin $sousadmin){
        return view('sous_admin/edit', compact('sousadmin'));
    }
   

    public function defineAccess($email){
        //Vérification si le sous-admin existe déjà
        $checkSousadminExiste = SousAdmin::where('email', $email)->first();

        if($checkSousadminExiste){
            return view('sous_admin.auth.validate-account', compact('email'));
        }else{
            return redirect()->route('sous_admin.login');
        };
    }

    public function submitDefineAccess(Request $request){

    try {
        
        $sousadmin = SousAdmin::where('email', $request->email)->first();

        if ($sousadmin) {
            // Mise à jour du mot de passe
            $sousadmin->password = Hash::make($request->password);

            // Vérifier si une image est uploadée
            if ($request->hasFile('profile_picture')) {
                // Supprimer l'ancienne photo si elle existe
                if ($sousadmin->profile_picture) {
                    Storage::delete('public/' . $sousadmin->profile_picture);
                }

                // Stocker la nouvelle image
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $sousadmin->profile_picture = $imagePath;
            }
            $sousadmin->update();

            if($sousadmin){
               $existingcode =  ResetCodePassword::where('email', $sousadmin->email)->count();

               if($existingcode > 1){
                   ResetCodePassword::where('email', $sousadmin->email)->delete();
               }
            }

            return redirect()->route('sous_admin.login')->with('success', 'Compte mis à jour avec succès');
        } else {
            return redirect()->route('sous_admin.login')->with('error', 'Email inconnu');
        }
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}

    public function update(updateDoctorRequest $request, SousAdmin $sousadmin)
    {	
        try {
            //code...
        } catch (Exception $e) {
           // dd($e);
            throw new Exception('Une erreur est subvenue lors de la modification du Docteur');
        }
    }

    public function delete(SousAdmin $sousadmin){
        try { 
            //code...
        } catch (Exception $e) {
            //dd($e);
            throw new Exception('Une erreur est subvenue lors de la suppression du Docteur');
    }
  }

  public function superindex() {
    
    $sousadmins = SousAdmin::all();
    $alerts = Alert::all();
    return view('sous_admin.superindex', compact('sousadmins','alerts'));
}

  public function souslogin(){
    Auth::guard('sous_admin')->logout();
    return view('sous_admin.auth.login');
}

public function soushandleLogin(Request $request)
{
    // Validation des champs du formulaire
    $request->validate([
        'email' => 'required|exists:sous_admins,email',
        'password' => 'required|min:8',
    ], [
        'email.required' => 'Le mail est obligatoire.',
        'email.exists' => 'Cette adresse mail n\'existe pas.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit avoir au moins 8 caractères.',
    ]);

    try {
        // Récupérer le sous-administrateur par son email
        $sousAdmin = SousAdmin::where('email', $request->email)->first();

        // Vérifier si le sous-administrateur est archivé
        if ($sousAdmin && $sousAdmin->archived_at !== null) {
            return redirect()->back()->with('error', 'Votre compte a été supprimé. Vous ne pouvez pas vous connecter.');
        }

        // Tenter la connexion
        if (auth('sous_admin')->attempt($request->only('email', 'password'))) {
            // Récupérer l'utilisateur authentifié
            $sousAdmin = auth('sous_admin')->user();
            $sousAdminId = $sousAdmin->id;

            // Rediriger vers la page spécifique en fonction de l'ID
            return redirect()->route('sous_admin.dashboard', ['id' => $sousAdminId])
                ->with('success', 'Bienvenu sur votre page');
        } else {
            return redirect()->back()->with('error', 'Votre mot de passe ou votre adresse mail est incorrect.');
        }
    } catch (Exception $e) {
        // Gérer les erreurs
        return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la connexion.');
    }
}

public function signature()
{
    $sousAdmin = Auth::guard('sous_admin')->user();
    return view('sous_admin.signature', compact('sousAdmin'));
}

public function updateSignature(UpdateSignatureRequest $request) 
{
    $sousAdmin = Auth::guard('sous_admin')->user();

    if ($request->hasFile('signature')) {
        // Valider et stocker la nouvelle signature
        $path = $request->file('signature')->store('signatures', 'public');

        // Supprimer l'ancienne signature si elle existe
        if ($sousAdmin->signature && Storage::disk('public')->exists($sousAdmin->signature)) {
            Storage::disk('public')->delete($sousAdmin->signature);
        }

        $sousAdmin->signature = $path;
    }

    $sousAdmin->update();
    return redirect()->route('sous_admin.signature')->with('success', 'Signature mise à jour avec succès.');
}

public function profil(){
        $sousAdmin = Auth::guard('sous_admin')->user();
        return view('sous_admin.auth.profil', compact('sousAdmin'));
    }

    public function updateProfil(Request $request)
    {
    // Valider les données du formulaire
    $request->validate([
        'name' => 'required|string|max:255',
        'prenom' =>'required|string|max:255',
        'email' =>'required|email|max:255',
        'contact' =>'required|string|max:255',
        // Ajoutez d'autres champs si nécessaire
    ]); 
        try {
            $sousAdmin = Auth::guard('sous_admin')->user();
            if (!$sousAdmin) {
                return redirect()->back()->with('error', 'Utilisateur non trouvé.');
            }
            // Gestion de l'image de profil
            if ($request->hasFile('profile_picture')) {
                // Supprimer l'ancienne image si elle existe
                if ($sousAdmin->profile_picture && Storage::exists('public/' . $sousAdmin->profile_picture)) {
                    Storage::delete('public/' . $sousAdmin->profile_picture);
                }
    
                // Stocker la nouvelle image
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $sousAdmin->profile_picture = $imagePath;
                $sousAdmin->save();
            }
            $sousAdmin->name = $request->name;
            $sousAdmin->prenom = $request->prenom;
            $sousAdmin->email = $request->email;
            $sousAdmin->contact = $request->contact;
            $sousAdmin->update(); 
    
            return redirect()->route('sous_admin.profil')->with('success', 'Profil mis à jour avec succès.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour du profil.');
        }
    }
}
