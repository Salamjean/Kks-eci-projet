<?php

namespace App\Http\Controllers;

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
    
            // Récupérer les naissances et naissancesD pour l'utilisateur
            $naissances = Naissance::where('user_id', $user->id)->get()->map(function ($naissance) {
                $naissance->type = 'naissance';
                return $naissance;
            });
    
            $naissancesD = NaissanceD::where('user_id', $user->id)->get()->map(function ($naissanceD) {
                $naissanceD->type = 'naissance';
                return $naissanceD;
            });

            // Combiner les deux collections
            $demandes = $naissances->concat($naissancesD);
       
            // Compter le nombre de demandes effectuées par l'utilisateur
            $nombreDemandes = $naissances->count() + $naissancesD->count();
    
            return view('dashboard', compact('user', 'demandes', 'nombreDemandes'));
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

 