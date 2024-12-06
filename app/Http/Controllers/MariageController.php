<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveMariageRequest;
use App\Models\Alert;
use App\Models\Mariage;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MariageController extends Controller
{
    public function index(Request $request)
    {
        $mariages = Mariage::all();
        $alerts = Alert::all();
    $query = Mariage::query();

    // Vérifier le type de recherche et appliquer le filtre
    if ($request->filled('searchType') && $request->filled('searchInput')) {
        if ($request->searchType === 'nomConjoint') {
            $query->where('nomEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('nomEpouse', 'like', '%' . $request->searchInput . '%'); // Recherche dans les deux colonnes (nomEpoux, nomEpouse)
        } elseif ($request->searchType === 'prenomConjoint') {
            $query->where('prenomEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('prenomEpouse', 'like', '%' . $request->searchInput . '%'); // Recherche dans les deux colonnes (prenomEpoux, prenomEpouse)
        } elseif ($request->searchType === 'lieuNaissance') {
            $query->where('lieuNaissanceEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('lieuNaissanceEpouse', 'like', '%' . $request->searchInput . '%'); // Recherche dans les deux colonnes (lieuNaissanceEpoux, lieuNaissanceEpouse)
        }
    }

    // Récupérer les résultats filtrés
    $mariages = $query->get();
        
        // Filtrer les mariages où nomEpoux, prenomEpoux, dateNaissanceEpoux, lieuNaissanceEpoux et commune sont null
        // mais pieceIdentite et extraitMariage sont remplis
        $mariagesAvecFichiersSeulement = $mariages->filter(function($mariage) {
            return is_null($mariage->nomEpoux) && is_null($mariage->prenomEpoux) && 
                   is_null($mariage->dateNaissanceEpoux) && is_null($mariage->lieuNaissanceEpoux) && 
                   is_null($mariage->commune) && $mariage->pieceIdentite && $mariage->extraitMariage;
        });
    
        // Filtrer les mariages où nomEpoux, prenomEpoux, dateNaissanceEpoux, lieuNaissanceEpoux, pieceIdentite et extraitMariage sont tous remplis
        $mariagesComplets = $mariages->filter(function($mariage) {
            return $mariage->nomEpoux && $mariage->prenomEpoux && $mariage->dateNaissanceEpoux &&
                   $mariage->lieuNaissanceEpoux && $mariage->pieceIdentite && $mariage->extraitMariage;
        });
    
        return view('mariages.index', compact('mariagesAvecFichiersSeulement', 'mariagesComplets', 'mariages','alerts'));
    }
    
    


    public function create(){
        return view('mariages.create');
    }


    public function edit(Mariage $mariage){
        return view('mariages.edit', compact('mariage'));
    }

    public function store(SaveMariageRequest $request)
{
    $imageBaseLink = '/images/mariages/';

    // Liste des fichiers à traiter
    $filesToUpload = [
        'pieceIdentite' => 'identite/',
        'extraitMariage' => 'extrait/',
    ];

    $uploadedPaths = []; // Contiendra les chemins des fichiers uploadés

    foreach ($filesToUpload as $fileKey => $subDir) {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $extension = $file->getClientOriginalExtension();
            $newFileName = (string) Str::uuid() . '.' . $extension;
            $file->storeAs("public/images/mariages/$subDir", $newFileName);

            // Ajouter le chemin public à $uploadedPaths
            $uploadedPaths[$fileKey] = $imageBaseLink . "$subDir" . $newFileName;
        }
    }

    // Récupérer la commune de l'utilisateur connecté

    // Enregistrement de l'objet Mariage
    $mariage = new Mariage();
    $mariage->nomEpoux = $request->nomEpoux;
    $mariage->prenomEpoux = $request->prenomEpoux;
    $mariage->dateNaissanceEpoux = $request->dateNaissanceEpoux;
    $mariage->lieuNaissanceEpoux = $request->lieuNaissanceEpoux;

    // Ajouter les fichiers uploadés à l'objet si disponibles
    $mariage->pieceIdentite = $uploadedPaths['pieceIdentite'] ?? null;
    $mariage->extraitMariage = $uploadedPaths['extraitMariage'] ?? null;

    // Associer la commune (via le champ `commune`)

    $mariage->save();
    Alert::create([
        'type' => 'mariage',
        'message' => "Une nouvelle Demnade d'extrait de mariage a été enregistrée : {$mariage->nomEpoux}.",
    ]);

    // Redirection avec un message de succès
    return redirect()->route('dashboard')->with('success', 'Déclaration de mariage enregistrée avec succès.');
}

public function show($id)
{   
    $alerts = Alert::all();
    $users = User::all();
    $mariage = Mariage::findOrFail($id); // Récupérer les données ou générer une erreur 404 si non trouvé
    return view('mariages.details', compact('mariage', 'users','alerts'));
}
    

}
