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

    // Récupérer les naissances associées au lieu de naissance de cet admin
    $naissances = Naissance::where('lieuNaiss', $admin->name)->get();
 
    // Calcul des données globales
    
    $totalData = Naissance::count() +NaissanceD::count() + Deces::count() + Mariage::count();
    $naissancePercentage = $totalData > 0 ? (Naissance::count() / $totalData) * 100 : 0;
    $naissanceDPercentage = $totalData > 0 ? (NaissanceD::count() / $totalData) * 100 : 0;
    $decesPercentage = $totalData > 0 ? (Deces::count() / $totalData) * 100 : 0;
    $mariagePercentage = $totalData > 0 ? (Mariage::count() / $totalData) * 100 : 0;
    $totalNaiss = $naissancePercentage + $naissanceDPercentage;

    // Données pour le tableau de bord
    $naissancedash = Naissance::count();
    $decesdash = Deces::count();
    $mariagedash = Mariage::count();
    $naissanceDdash = NaissanceD::count();
    $Naiss = Naissance::count() + NaissanceD::count();
    

    // Récupération des données récentes
    $recentNaissances = Naissance::orderBy('created_at', 'desc')->take(3)->get();
    $recentDeces = Deces::orderBy('created_at', 'desc')->take(3)->get();
    $recentMariages = Mariage::orderBy('created_at', 'desc')->take(3)->get();
    $alerts = Alert::where('is_read', false)
    ->whereIn('type', ['naissance','mariage', 'deces'])  // Filtrer les alertes par type
    ->latest()
    ->get();

    $naissancesD = NaissanceD::all();

    // Retourne la vue avec les données
    return view('vendor.dashboard', compact(
        'naissancedash',
        'decesdash',
        'mariagedash',
        'naissances',
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
        'naissancesD',
        'totalNaiss'
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
