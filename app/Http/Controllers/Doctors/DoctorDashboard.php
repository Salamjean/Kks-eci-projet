<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Models\DecesHop;
use App\Models\NaissHop;
use App\Models\SousAdmin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDashboard extends Controller
{
public function index(Request $request)
{
    // Récupérer le sousadmin connecté
    $sousadmin = auth('doctor')->user();

    // Récupérer les détails du sousadmin
    $sousadminDetails = SousAdmin::find($sousadmin->id);

    // Récupérer le mois et l'année sélectionnés, ou la date actuelle par défaut
    $selectedMonth = $request->input('month', Carbon::now()->month);
    $selectedYear = $request->input('year', Carbon::now()->year);

    // Compter le total des déclarations pour le mois sélectionné
    $communeAdmin = $sousadmin->nomHop;
    $docteur = SousAdmin::where('nomHop', $communeAdmin)
        ->whereYear('created_at', $selectedYear)
        ->count();
    $naisshop = NaissHop::where('NomEnf', $communeAdmin)
        ->whereYear('created_at', $selectedYear)
        ->count();
    $deceshop = DecesHop::where('nomHop', $communeAdmin)
        ->whereYear('created_at', $selectedYear)
        ->count();

    // Récupérer les données pour les graphiques (Naissances)
    $naissData = NaissHop::where('NomEnf', $communeAdmin)
        ->whereYear('created_at', $selectedYear)
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')->toArray();

    // Remplir les données manquantes pour les naissances
    $naissData = array_replace(array_fill(1, 12, 0), $naissData);

    // Calculer le total des déclarations
    $total = $naisshop + $deceshop;

    // Récupérer les données pour les graphiques (Décès)
    $decesData = DecesHop::where('nomHop', $communeAdmin)
        ->whereYear('created_at', $selectedYear)
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month')->toArray();

    // Remplir les données manquantes pour les décès
    $decesData = array_replace(array_fill(1, 12, 0), $decesData);

    // Passer les données à la vue
    return view('doctor.dashboard', compact(
        'sousadminDetails',
        'naisshop',
        'deceshop',
        'docteur',
        'total',
        'selectedMonth',
        'selectedYear',
        'naissData',
        'decesData'
    ));
}

}