<?php

namespace App\Http\Controllers;

use App\Models\Deces;
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
        
            // Récupérer les naissances et les marquer avec le type "naissance"
            $naissances = Naissance::where('user_id', $user->id)->get()->map(function ($naissance) {
                $naissance->type = 'naissance';
                return $naissance;
            });
        
            // Récupérer les naissances différées et les marquer avec le type "naissanceD"
            $naissancesD = NaissanceD::where('user_id', $user->id)->get()->map(function ($naissanceD) {
                $naissanceD->display_type = 'naissanceD'; // Utilise une nouvelle propriété pour l'affichage
                return $naissanceD;
            });
        
            // Récupérer les décès et les marquer avec le type "deces"
            $deces = Deces::where('user_id', $user->id)->get()->map(function ($deces) {
                $deces->type = 'deces';
                return $deces;
            });
        
            // Récupérer les mariages et les marquer avec le type "mariage"
            $mariages = Mariage::where('user_id', $user->id)->get()->map(function ($mariage) {
                $mariage->type = 'mariage';
                return $mariage;
            });
        
            // Combiner toutes les collections
            $demandes = $naissances->concat($naissancesD)->concat($deces)->concat($mariages);
            $naissancesCount = Naissance::where('user_id', $user->id)->count();
            $naissanceDCount = NaissanceD::where('user_id', $user->id)->count();
            $decesCount = Deces::where('user_id', $user->id)->count();
            $mariageCount = Mariage::where('user_id', $user->id)->count();
            // Compter le nombre total de demandes
            $nombreDemandes = $demandes->count();
        
            return view('utilisateur.dashboard', compact('user', 'demandes', 'nombreDemandes',
            'naissancesD','naissancesCount','naissanceDCount','decesCount','mariageCount'));
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

 