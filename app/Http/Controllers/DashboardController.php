<?php

namespace App\Http\Controllers;

use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        $user = Auth::user();

        // Récupérer les demandes avec leurs types respectifs
        $naissances = Naissance::where('user_id', $user->id)->get()->map(function ($naissance) {
            $naissance->type = 'naissance';
            return $naissance;
        });

        $naissancesD = NaissanceD::where('user_id', $user->id)->get()->map(function ($naissanceD) {
            $naissanceD->display_type = 'naissanceD';
            return $naissanceD;
        });

        $deces = Deces::where('user_id', $user->id)->get()->map(function ($deces) {
            $deces->type = 'deces';
            return $deces;
        });

        $decesdeja = Decesdeja::where('user_id', $user->id)->get()->map(function ($decesdeja) {
            $decesdeja->type = 'deces';
            return $decesdeja;
        });

        $mariages = Mariage::where('user_id', $user->id)->get()->map(function ($mariage) {
            $mariage->type = 'mariage';
            return $mariage;
        });

        // Combiner toutes les demandes
        $demandes = $naissances->concat($naissancesD)->concat($deces)->concat($mariages)->concat($decesdeja);

        // Trier les demandes par date de création (les plus récentes en premier)
        $demandesRecente = $demandes->sortByDesc('created_at')->take(5);;

         // Calcul des totaux pour les groupes fusionnés
         $naissancesCount = Naissance::where('user_id', $user->id)->count();
         $naissanceDCount = NaissanceD::where('user_id', $user->id)->count();
         $decesCount = Deces::where('user_id', $user->id)->count();
         $decesdejaCount = Decesdeja::where('user_id', $user->id)->count();
         $mariageCount = Mariage::where('user_id', $user->id)->count();
 
         // Calcul des totaux fusionnés
         $totalNaissances = $naissancesCount + $naissanceDCount;
         $totalDeces = $decesCount + $decesdejaCount;

        // Compter le nombre total de demandes
        $nombreDemandes = $demandes->count();

        // Passer les demandes récentes à la vue
        return view('utilisateur.dashboard', compact('user', 'demandesRecente', 'nombreDemandes', 
            'naissancesD', 'naissancesCount', 'naissanceDCount', 'decesCount', 'decesdejaCount', 'mariageCount','totalNaissances', 'totalDeces'));
    }

    return redirect()->route('login');
}


    public function show($id)
    {
        // Trouver l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Retourner la vue avec les informations de l'utilisateur
        return view('dashboard', compact('user'));
    }

    
}

 