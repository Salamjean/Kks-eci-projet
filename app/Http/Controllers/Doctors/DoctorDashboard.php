<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Models\DecesHop;
use App\Models\NaissHop;
use App\Models\SousAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDashboard extends Controller
{
    public function index(Request $request)
{
    // Récupérer le sousadmin connecté
    $sousadmin = Auth::guard('doctor')->user();
    
    // Utiliser l'identifiant ou un autre critère pour récupérer plus d'infos sur ce sousadmin
    $sousadminDetails = SousAdmin::where('id', $sousadmin->id)->first(); // ou `find($sousadmin->id)`

    // Récupérer le mois et l'année sélectionnés
    $selectedMonth = $request->input('month', date('m'));
    $selectedYear = $request->input('year', date('Y'));

    // Compter le total des déclarations de naissance et de décès pour le mois sélectionné
    $communeAdmin = $sousadmin->nomHop;
    $docteur = SousAdmin::where('nomHop', $communeAdmin)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->count();

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

    // Calculer le total
    $total = $naisshop + $deceshop;

    // Passer les données à la vue
    return view('doctor.dashboard', compact('sousadminDetails', 'naisshop', 'deceshop', 'docteur', 'total', 'selectedMonth', 'selectedYear', 'naissData', 'decesData'));
}


    public function logout(){
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }

    
}
