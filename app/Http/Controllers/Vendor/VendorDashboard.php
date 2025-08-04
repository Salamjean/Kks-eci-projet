<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\DecesHop;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\NaissHop;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorDashboard extends Controller
{
    
    public function index(Request $request)
{
     Carbon::setLocale('fr');
    // Récupérer l'admin connecté
    $admin = Auth::guard('vendor')->user();

    // Récupérer le mois et l'année sélectionnés pour les naissances, décès et mariages
    $selectedMonth = $request->input('month', date('m'));
    $selectedYear = $request->input('year', date('Y'));

    // Récupérer le mois et l'année sélectionnés pour les naisshops et deceshops
    $selectedMonthHops = $request->input('month_hops', date('m'));
    $selectedYearHops = $request->input('year_hops', date('Y'));

    // Récupérer les données associées à la commune de cet admin pour le mois sélectionné
    // Données pour naissances, décès, et mariages
    $naissances = Naissance::where('commune', $admin->name)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    $naissancesD = NaissanceD::where('commune', $admin->name)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    $deces = Deces::where('commune', $admin->name)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();
        
    $decesdeja = Decesdeja::where('commune', $admin->name)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();
    $mariages = Mariage::where('commune', $admin->name)
        ->whereMonth('created_at', $selectedMonth)
        ->whereYear('created_at', $selectedYear)
        ->orderBy('created_at', 'desc')
        ->get();

    // Données pour naisshops et deceshops
    $naisshops = NaissHop::where('commune', $admin->name)
        ->whereMonth('created_at', $selectedMonthHops)
        ->whereYear('created_at', $selectedYearHops)
        ->orderBy('created_at', 'desc')
        ->get();

    $deceshops = DecesHop::where('commune', $admin->name)
        ->whereMonth('created_at', $selectedMonthHops)
        ->whereYear('created_at', $selectedYearHops)
        ->orderBy('created_at', 'desc')
        ->get();

    // Calcul des données globales
    $totalData = $naissances->count() + $naissancesD->count() + $decesdeja->count() + $deces->count() + $mariages->count();
    $totalDataHops = $naisshops->count() + $deceshops->count();

    // Pourcentages
    $naissancePercentage = $totalData > 0 ? ($naissances->count() / $totalData) * 100 : 0;
    $naissanceDPercentage = $totalData > 0 ? ($naissancesD->count() / $totalData) * 100 : 0;
    $decesPercentage = $totalData > 0 ? ($deces->count() / $totalData) * 100 : 0;
    $decesdejaPercentage = $totalData > 0 ? ($decesdeja->count() / $totalData) * 100 : 0;
    $mariagePercentage = $totalData > 0 ? ($mariages->count() / $totalData) * 100 : 0;
    $naisshopPercentage = $totalDataHops > 0 ? ($naisshops->count() / $totalDataHops) * 100 : 0;
    $deceshopPercentage = $totalDataHops > 0 ? ($deceshops->count() / $totalDataHops) * 100 : 0;

    $NaissP = $naissancePercentage + $naissanceDPercentage;    
    $DecesP = $decesPercentage + $decesdejaPercentage;    
    $NaissHop = $naisshopPercentage + $deceshopPercentage; 

    // Données pour le tableau de bord
    $naissancedash = $naissances->count();
    $decesdash = $deces->count();
    $decesdejadash = $decesdeja->count();
    $mariagedash = $mariages->count();
    $naissanceDdash = $naissancesD->count();
    $naisshopsdash = $naisshops->count();
    $deceshopsdash = $deceshops->count();
    $Naiss = $naissancedash + $naissanceDdash;
    $Dece = $decesdash + $decesdejadash;
    $NaissHopTotal = $naisshopsdash + $deceshopsdash;

    // Récupération des données récentes (3 derniers éléments)
    $recentNaissances = $naissances->take(2);
    $recentNaissancesd = $naissancesD->take(2);
    $recentDeces = $deces->take(2);
    $recentDecesdeja = $decesdeja->take(2);
    $recentMariages = $mariages->take(2);
    $recentNaisshops = $naisshops->take(2);
    $recentDeceshops = $deceshops->take(2);

    $alerts = Alert::where('is_read', false)
    ->whereIn('type', ['naissance','decesdeja', 'mariage', 'deces','decesHop','naissHop'])  
    ->latest()
    ->get();

    // Retourne la vue avec les données
    return view('vendor.dashboard', compact(
        'naissancedash', 'naisshopsdash', 'deceshopsdash','decesdejadash', 
        'NaissHopTotal', 'decesdash', 'NaissP','DecesP', 'mariagedash', 
        'naissances', 'naissancesD', 'deces','decesdeja', 'mariages', 
        'totalDataHops', 'totalData', 'naissancePercentage', 
        'naissanceDPercentage', 'decesPercentage', 'mariagePercentage', 
        'naisshopPercentage', 'deceshopPercentage', 
        'recentNaissances', 'recentDeces', 'recentMariages', 
        'alerts', 'Naiss','Dece','recentDecesdeja', 'NaissHop', 
        'selectedMonth', 'selectedYear', 
        'selectedMonthHops', 'selectedYearHops','recentNaisshops', 'recentDeceshops','recentNaissancesd'
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
