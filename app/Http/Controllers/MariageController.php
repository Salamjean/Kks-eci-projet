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

        // Initialiser la requête pour Mariage et filtrer par commune de l'admin
        $query = Mariage::where('commune', $admin->name); // Filtrer par commune de l'admin connecté

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

        // Récupérer tous les mariages correspondant aux critères de filtrage
        $mariages = $query->get();

        // Filtrer les mariages où pieceIdentite et extraitMariage sont remplis et la commune est celle de l'admin
        $mariagesAvecFichiersSeulement = $mariages->filter(function($mariage) use ($admin) {
            return !is_null($mariage->pieceIdentite) && !is_null($mariage->extraitMariage) && $mariage->commune == $admin->name;
        });

        // Filtrer les mariages où nomEpoux, prenomEpoux, dateNaissanceEpoux, lieuNaissanceEpoux, commune sont remplis
        $mariagesComplets = $mariages->filter(function($mariage) {
            return $mariage->nomEpoux && $mariage->prenomEpoux && $mariage->dateNaissanceEpoux &&
                   $mariage->lieuNaissanceEpoux && $mariage->commune && $mariage->pieceIdentite && $mariage->extraitMariage;
        });

        // Récupérer toutes les alertes
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();

        // Retourner la vue avec les mariages filtrés et les alertes
        return view('mariages.index', compact('mariagesAvecFichiersSeulement', 'mariagesComplets', 'mariages', 'alerts'));
    }

    public function userindex(Request $request)
    {
        // Récupérer l'admin connecté
        $admin = Auth::user();

        // Initialiser la requête pour Mariage et filtrer par commune de l'admin
        $query = Mariage::where('user_id', $admin->id); // Filtrer par commune de l'admin connecté

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

        // Récupérer tous les mariages correspondant aux critères de filtrage
        $mariages = $query->get();

        // Filtrer les mariages où pieceIdentite et extraitMariage sont remplis et la commune est celle de l'admin
        $mariagesAvecFichiersSeulement = $mariages->filter(function($mariage) use ($admin) {
            return !is_null($mariage->pieceIdentite) && !is_null($mariage->extraitMariage) && $mariage->user_id == $admin->id;
        });

        // Filtrer les mariages où nomEpoux, prenomEpoux, dateNaissanceEpoux, lieuNaissanceEpoux, commune sont remplis
        $mariagesComplets = $mariages->filter(function($mariage) {
            return $mariage->nomEpoux && $mariage->prenomEpoux && $mariage->dateNaissanceEpoux &&
                   $mariage->lieuNaissanceEpoux && $mariage->commune && $mariage->pieceIdentite && $mariage->extraitMariage;
        });

        // Récupérer toutes les alertes
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();

        // Retourner la vue avec les mariages filtrés et les alertes
        return view('mariages.userindex', compact('mariagesAvecFichiersSeulement', 'mariagesComplets', 'mariages', 'alerts'));
    }
    public function agentindex(Request $request)
    {
        // Récupérer l'admin connecté
        $admin = Auth::guard('agent')->user();

        // Initialiser la requête pour Mariage et filtrer par commune de l'admin
        $query = Mariage::where('commune', $admin->communeM)
        ->where('agent_id', $admin->id); // Filtrer par commune de l'admin connecté

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

        // Récupérer tous les mariages correspondant aux critères de filtrage
        $mariages = $query->paginate(10);

        // Filtrer les mariages où pieceIdentite et extraitMariage sont remplis et la commune est celle de l'admin
        $mariagesAvecFichiersSeulement = $mariages->filter(function($mariage) use ($admin) {
            return !is_null($mariage->pieceIdentite) && !is_null($mariage->extraitMariage) && $mariage->commune == $admin->communeM;
        });

        // Filtrer les mariages où nomEpoux, prenomEpoux, dateNaissanceEpoux, lieuNaissanceEpoux, commune sont remplis
        $mariagesComplets = $mariages->filter(function($mariage) {
            return $mariage->nomEpoux && $mariage->prenomEpoux && $mariage->dateNaissanceEpoux &&
                   $mariage->lieuNaissanceEpoux && $mariage->commune && $mariage->pieceIdentite && $mariage->extraitMariage;
        });

        // Récupérer toutes les alertes
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();

        // Retourner la vue avec les mariages filtrés et les alertes
        return view('mariages.agentindex', compact('mariagesAvecFichiersSeulement', 'mariagesComplets', 'mariages', 'alerts'));
    }

    public function ajointindex(Request $request)
{
    // Récupérer l'admin connecté
    $admin = Auth::guard('ajoint')->user();
    // Initialiser la requête pour Mariage et filtrer par commune de l'admin
    $query = Mariage::where('commune', $admin->communeM); // Filtrer par commune de l'admin connecté
    // Vérifier le type de recherche et appliquer le filtre
    if ($request->filled('searchType') && $request->filled('searchInput')) {
        if ($request->searchType === 'nomConjoint') {
            $query->where('nomEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('nomEpouse', 'like', '%' . $request->searchInput . '%'); // Recherche dans les deux colonnes (nomEpoux, no
        } elseif ($request->searchType === 'prenomConjoint') {
            $query->where('prenomEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('prenomEpouse', 'like', '%' . $request->searchInput . '%'); // Recherche dans les deux colonnes (prenomEpo
        } elseif ($request->searchType === 'lieuNaissance') {
            $query->where('lieuNaissanceEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('lieuNaissanceEpouse', 'like', '%' . $request->searchInput . '%'); // Recherche dans les deux colonnes (li
        }
    }
    // Récupérer tous les mariages correspondant aux critères de filtrage
    $mariages = $query->paginate(10);
    // Filtrer les mariages où pieceIdentite et extraitMariage sont remplis et la commune est celle de l'admin
    $mariagesAvecFichiersSeulement = $mariages->filter(function($mariage) use ($admin) {
        return !is_null($mariage->pieceIdentite) && !is_null($mariage->extraitMariage) && $mariage->commune == $admin->communeM;
    });
    // Filtrer les mariages où nomEpoux, prenomEpoux, dateNaissanceEpoux, lieuNaissanceEpoux, commune sont remplis
    $mariagesComplets = $mariages->filter(function($mariage) {
        return $mariage->nomEpoux && $mariage->prenomEpoux && $mariage->dateNaissanceEpoux &&
               $mariage->lieuNaissanceEpoux && $mariage->commune && $mariage->pieceIdentite && $mariage->extraitMariage;
    });
    // Récupérer toutes les alertes
    $alerts = Alert::where('is_read', false)
    ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
    ->latest()
    ->get();
    // Retourner la vue avec les mariages filtrés et les alertes
    return view('mariages.ajointindex', compact('mariagesAvecFichiersSeulement', 'mariagesComplets', 'mariages', 'alerts'));
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
        
        // Récupérer la commune du formulaire ou par défaut celle de l'utilisateur
        $commune = $request->input('commune', $user->commune);
        
        // Enregistrement de l'objet Mariage
        $mariage = new Mariage();
        $mariage->nomEpoux = $request->nomEpoux;
        $mariage->prenomEpoux = $request->prenomEpoux;
        $mariage->dateNaissanceEpoux = $request->dateNaissanceEpoux;
        $mariage->lieuNaissanceEpoux = $request->lieuNaissanceEpoux;
        $mariage->pieceIdentite = $uploadedPaths['pieceIdentite'] ?? null;
        $mariage->extraitMariage = $uploadedPaths['extraitMariage'] ?? null;
        $mariage->commune = $commune; // Utilisation de la commune spécifiée
        $mariage->CMU = $request->CMU;
        $mariage->etat = 'en attente';
        $mariage->user_id = $user->id;  // Lier la demande à l'utilisateur connecté
        
        $mariage->save();
        
        Alert::create([
            'type' => 'mariage',
            'message' => "Une nouvelle demande d'extrait de mariage a été enregistrée : {$mariage->nomEpoux} {$mariage->prenomEpoux}.",
        ]);
        
        return redirect()->route('utilisateur.dashboard')->with('success', 'Votre demande a été traitée avec succès.');
    }
    

public function show($id)
{
    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();
    $users = User::all();
    $mariage = Mariage::with('user')->findOrFail($id); // Récupérer les données avec l'utilisateur
    return view('mariages.details', compact('mariage', 'users','alerts'));
}
    

}
