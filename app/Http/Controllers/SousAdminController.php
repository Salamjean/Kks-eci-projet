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
   
    public function dashboard(){
        try {
            $sousadmin = Auth::guard('sous_admin')->user();
            $communeAdmin = $sousadmin->commune;
    
            // Récupérer les déclarations de naissance récentes dans les dernières 24 heures
            $declarationsRecents = NaissHop::where('commune', $communeAdmin)
                ->where('created_at', '>=', now()->subHours(24))
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
    
            // Récupérer les déclarations de décès récentes dans les dernières 24 heures
            $decesRecents = DecesHop::where('commune', $communeAdmin)
                ->where('created_at', '>=', now()->subHours(24))
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
    
            // Compter les déclarations par mois
            $naisshopData = NaissHop::select(DB::raw("strftime('%Y-%m', created_at) as month"), DB::raw('count(*) as count'))
                ->where('commune', $communeAdmin)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month');
    
            $deceshopData = DecesHop::select(DB::raw("strftime('%Y-%m', created_at) as month"), DB::raw('count(*) as count'))
                ->where('commune', $communeAdmin)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month');
    
            // Compter le total des déclarations de naissance et de décès
            $naisshop = NaissHop::where('commune', $communeAdmin)->count();
            $deceshop = DecesHop::where('commune', $communeAdmin)->count();
            $total = $naisshop + $deceshop;
    
            // Combiner les données
            $months = $naisshopData->keys()->merge($deceshopData->keys())->unique()->sort();
            $naisshopCounts = $months->map(fn($month) => $naisshopData->get($month, 0))->toArray();
            $deceshopCounts = $months->map(fn($month) => $deceshopData->get($month, 0))->toArray();
    
            // Formater les mois pour l'affichage
            $formattedMonths = $months->map(fn($month) => \Carbon\Carbon::parse($month)->format('M Y'))->toArray();
    
            // Calculer les taux de croissance des naissances
            $naisshopRates = [];
            foreach ($naisshopCounts as $index => $count) {
                $previousCount = $index > 0 ? $naisshopCounts[$index - 1] : 0;
                $rate = $previousCount ? (($count - $previousCount) / $previousCount) * 100 : 0;
                $naisshopRates[] = $rate;
            }
    
            // Calculer les taux de croissance des décès
            $deceshopRates = [];
            foreach ($deceshopCounts as $index => $count) {
                $previousCount = $index > 0 ? $deceshopCounts[$index - 1] : 0;
                $rate = $previousCount ? (($count - $previousCount) / $previousCount) * 100 : 0;
                $deceshopRates[] = $rate;
            }
    
            // Passer les données à la vue
            return view('sous_admin.dashboard', compact('naisshop', 'deceshop', 'total', 'naisshopCounts', 'deceshopCounts', 'formattedMonths', 'declarationsRecents', 'decesRecents', 'naisshopRates', 'deceshopRates'));
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