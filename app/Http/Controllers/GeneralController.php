<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function general(){
        return view('pages.espace');
    }

    public function naissanceavec(){
        return view('pages.naissanceavec');
    }

    public function naissancesans(){
        return view('pages.naissancesans');
    }

    public function decesavec(){
        return view('pages.decesavec');
    }

    public function decessans(){
        return view('pages.decessans');
    }

    public function mariagesans(){
        return view('pages.mariage');
    }

    public function recherche(Request $request){
        $etatDemande = null; // Initialisation de l'état de la demande
        $reference = null; // Initialisation de la référence recherchée

        if ($request->isMethod('post')) { // Vérifier si c'est une requête POST (formulaire soumis)
            $reference = $request->input('reference_naissance'); // On utilise toujours le même nom de champ depuis la vue

            if ($reference) {
                // Rechercher dans la table 'naissances'
                $naissance = Naissance::where('reference', $reference)->first();
                if ($naissance) {
                    $etatDemande = $naissance->etat;
                    return view('pages.recherche', compact('etatDemande', 'reference')); // Passer $etatDemande et $reference à la vue
                }

                // Rechercher dans la table 'naissance_d_s' (en supposant que votre modèle est NaissanceDS)
                $naissanceDS = NaissanceD::where('reference', $reference)->first();
                if ($naissanceDS) {
                    $etatDemande = $naissanceDS->etat;
                    return view('pages.recherche', compact('etatDemande', 'reference'));
                }

                // Rechercher dans la table 'deces'
                $deces = Deces::where('reference', $reference)->first();
                if ($deces) {
                    $etatDemande = $deces->etat;
                    return view('pages.recherche', compact('etatDemande', 'reference'));
                }

                // Rechercher dans la table 'decesdejas' (en supposant que votre modèle est Decesdeja)
                $decesdeja = Decesdeja::where('reference', $reference)->first();
                if ($decesdeja) {
                    $etatDemande = $decesdeja->etat;
                    return view('pages.recherche', compact('etatDemande', 'reference'));
                }

                // Rechercher dans la table 'mariages'
                $mariage = Mariage::where('reference', $reference)->first();
                if ($mariage) {
                    $etatDemande = $mariage->etat;
                    return view('pages.recherche', compact('etatDemande', 'reference'));
                }

                $etatDemande = false; // Aucune demande trouvée pour cette référence dans aucune table
            }
        }

        return view('pages.recherche', compact('etatDemande', 'reference')); // Passer $etatDemande et $reference à la vue
    }

    
    
}
