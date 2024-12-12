<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorDashboard extends Controller
{
    public function index()
    {
        // Récupérer l'admin connecté
        $admin = Auth::guard('vendor')->user(); // Assurez-vous que l'authentification utilise 'vendor'
    
        // Récupérer les naissances, naissancesD, deces et mariages associés à la commune de cet admin
        $naissances = Naissance::where('commune', $admin->name)->orderBy('created_at', 'desc')->get();
        $naissancesD = NaissanceD::where('commune', $admin->name)->orderBy('created_at', 'desc')->get();
        $deces = Deces::where('commune', $admin->name)->orderBy('created_at', 'desc')->get();
        $mariages = Mariage::where('commune', $admin->name)->orderBy('created_at', 'desc')->get();
    
        // Calcul des données globales selon la commune
        $totalData = $naissances->count() + $naissancesD->count() + $deces->count() + $mariages->count();
        $naissancePercentage = $totalData > 0 ? ($naissances->count() / $totalData) * 100 : 0;
        $naissanceDPercentage = $totalData > 0 ? ($naissancesD->count() / $totalData) * 100 : 0;
        $decesPercentage = $totalData > 0 ? ($deces->count() / $totalData) * 100 : 0;
        $mariagePercentage = $totalData > 0 ? ($mariages->count() / $totalData) * 100 : 0;
        $NaissP = $naissancePercentage + $naissanceDPercentage; // Pourcentage des naissances et naissancesD	
    
        // Données pour le tableau de bord
        $naissancedash = $naissances->count();
        $decesdash = $deces->count();
        $mariagedash = $mariages->count();
        $naissanceDdash = $naissancesD->count();
        $Naiss = $naissancedash + $naissanceDdash;
    
        // Récupération des données récentes (3 derniers éléments)
        $recentNaissances = $naissances->take(3);
        $recentDeces = $deces->take(3);
        $recentMariages = $mariages->take(3);
    
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces'])  // Filtrer les alertes par type
            ->latest()
            ->get();
    
        // Retourne la vue avec les données
        return view('vendor.dashboard', compact(
            'naissancedash',
            'decesdash',
            'NaissP',
            'mariagedash',
            'naissances',
            'naissancesD',
            'deces',
            'mariages',
            'totalData',
            'naissancePercentage',
            'naissanceDPercentage',
            'decesPercentage',
            'mariagePercentage',
            'recentNaissances',
            'recentDeces',
            'recentMariages', 
            'alerts',
            'Naiss',
        ));
    }
public function markAlertAsRead($id)
{
    // Récupérer l'alerte par son ID
    $alert = Alert::findOrFail($id);
    
    // Marquer l'alerte comme lue
    $alert->is_read = true;
    $alert->save();

    return response()->json(['message' => 'Alerte marquée comme lue']);
}


    public function logout(){
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }

    public function updateEtat(Request $request, $id)
{
    $request->validate(['etat' => 'required|string']);

    try {
        $naissance = Naissance::findOrFail($id);
        $naissance->etat = $request->etat;
        $naissance->save();

        return response()->json(['status' => 'success', 'message' => 'État mis à jour.']);
    } catch (Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Erreur lors de la mise à jour.']);
    }
}

}
