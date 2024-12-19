<?php

namespace App\Http\Controllers;

use App\Http\Requests\SousAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\updateDoctorRequest;
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
   
    public function dashboard(Request $request){
        try {
            $sousadmin = Auth::guard('sous_admin')->user();
            $communeAdmin = $sousadmin->nomHop;
    
            // Récupérer les déclarations de naissances du jour en cours
            $declarationsRecents = NaissHop::where('NomEnf', $communeAdmin)
                ->whereDate('created_at', now()->format('Y-m-d')) // Filtrer par date
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
                
            // Récupérer les déclarations de deces du jour en cours
            $decesRecents = DecesHop::where('nomHop', $communeAdmin)
                ->whereDate('created_at', now()->format('Y-m-d')) // Filtrer par date
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
    
            // Compter les déclarations par mois
            $naisshopData = NaissHop::select(DB::raw("strftime('%Y-%m', created_at) as month"), DB::raw('count(*) as count'))
                ->where('NomEnf', $communeAdmin)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month');
    
            $deceshopData = DecesHop::select(DB::raw("strftime('%Y-%m', created_at) as month"), DB::raw('count(*) as count'))
                ->where('nomHop', $communeAdmin)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month');
    
                    // Récupérer le mois et l'année sélectionnés
            $selectedMonth = $request->input('month', date('m'));
            $selectedYear = $request->input('year', date('Y'));

            // Compter le total des déclarations de naissance et de décès pour le mois sélectionné
            $naisshop = NaissHop::where('NomEnf', $communeAdmin)
                ->whereMonth('created_at', $selectedMonth)
                ->whereYear('created_at', $selectedYear)
                ->count();

            $deceshop = DecesHop::where('nomHop', $communeAdmin)
                ->whereMonth('created_at', $selectedMonth)
                ->whereYear('created_at', $selectedYear)
                ->count();

            // Récupérer les données pour les graphiques
            $naissData = NaissHop::where('NomEnf', $communeAdmin)
                ->whereYear('created_at', $selectedYear)
                ->selectRaw('strftime("%m", created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')->toArray();

            $decesData = DecesHop::where('nomHop', $communeAdmin)
                ->whereYear('created_at', $selectedYear)
                ->selectRaw('strftime("%m", created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')->toArray();

            // Remplir les données manquantes pour chaque mois
            $naissData = array_replace(array_fill(1, 12, 0), $naissData);
            $decesData = array_replace(array_fill(1, 12, 0), $decesData);

            $total = $naisshop + $deceshop;
    
            // Passer les données à la vue
            return view('sous_admin.dashboard', compact('naisshop', 'deceshop', 'total', 'selectedMonth', 'selectedYear', 'naissData', 'decesData', 'declarationsRecents', 'decesRecents'));
        } catch (Exception $e) {
            dd($e);
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

    public function submitDefineAccess(submitDefineAccessRequest $request){

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
               $existingcode =  ResetCodePassword::where('eamil', $sousadmin->email)->count();

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

  public function souslogin(){
    Auth::guard('sous_admin')->logout();
    return view('sous_admin.auth.login');
}
public function soushandleLogin(Request $request)
{
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
        dd($e);
    }
} 
}