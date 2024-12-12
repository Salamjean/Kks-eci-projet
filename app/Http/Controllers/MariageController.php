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
    // Récupérer l'admin connecté
    $admin = Auth::guard('vendor')->user();

    // Initialiser la requête pour Mariage
    $query = Mariage::where('commune', $admin->name); // Filtrer par commune

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
    $alerts = Alert::all();
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

    return view('mariages.index', compact('mariagesAvecFichiersSeulement', 'mariagesComplets', 'mariages', 'alerts'));
}
    
    


    public function create(){
        return view('mariages.create');
    }


    public function edit(Mariage $mariage){
        return view('mariages.edit', compact('mariage'));
    }

    public function store(saveMariageRequest $request)
    {
        $imageBaseLink = '/images/mariages/';
    
        // Liste des fichiers à traiter
        $filesToUpload = [
            'pieceIdentite' => 'identite/', 
            'extraitMariage' => 'extrait/', // Si ce fichier est présent
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
    
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Enregistrement de l'objet Mariage
        $mariage = new Mariage();
        $mariage->nomEpoux = $request->nomEpoux;
        $mariage->prenomEpoux = $request->prenomEpoux;
        $mariage->dateNaissanceEpoux = $request->dateNaissanceEpoux;
        $mariage->lieuNaissanceEpoux = $request->lieuNaissanceEpoux;
        $mariage->pieceIdentite = $uploadedPaths['pieceIdentite'] ?? null;
        $mariage->extraitMariage = $uploadedPaths['extraitMariage'] ?? null;
        $mariage->commune = $user->commune;
        $mariage->etat = 'En attente';
        $mariage->user_id = $user->id;  // Lier la demande à l'utilisateur connecté
    
        $mariage->save();
    
        Alert::create([
            'type' => 'mariage',
            'message' => "Une nouvelle demande d'extrait de mariage a été enregistrée : {$mariage->nomEpoux} {$mariage->prenomEpoux}.",
        ]);
    
        return redirect()->back()->with('success', 'Votre demande a été traitée avec succès.');
    }
    

public function show($id)
{   
    $alerts = Alert::all();
    $users = User::all();
    $mariage = Mariage::findOrFail($id); // Récupérer les données ou générer une erreur 404 si non trouvé
    return view('mariages.details', compact('mariage', 'users','alerts'));
}
    

}
