<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDecesRequest;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Decesdeja;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DecesController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer l'admin connecté
        $admin = Auth::guard('vendor')->user();
    
       // Récupérer les alertes
       $alerts = Alert::where('is_read', false)
       ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
       ->latest()
       ->get();
    
        // Initialiser la requête pour Deces en filtrant par commune
        $query = Deces::where('commune', $admin->name); // Filtrer par commune
        $querys = Decesdeja::where('commune', $admin->name); // Filtrer par commune
    
        // Vérifier le type de recherche et appliquer le filtre
        if ($request->filled('searchType') && $request->filled('searchInput')) {
            if ($request->searchType === 'nomDefunt') {
                $query->where('nomDefunt', 'like', '%' . $request->searchInput . '%');
            } elseif ($request->searchType === 'nomHopital') {
                $query->where('nomHopital', 'like', '%' . $request->searchInput . '%');
            }
        }
    
        // Récupérer les résultats filtrés
        $deces = $query->get();
        $decesdeja = $querys->get();
    
        return view('deces.index', compact('deces','decesdeja','alerts'));
    }

    public function superindex(Request $request)
    {
       // Récupérer les alertes
       $alerts = Alert::where('is_read', false)
       ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
       ->latest()
       ->get();
    
        // Initialiser la requête pour Deces en filtrant par commune
        $deces = Deces::all(); 
        $decesdeja = Decesdeja::all(); 
        return view('deces.superindex', compact('deces','decesdeja','alerts'));
    }
    

    public function userindex()
    {
        // Récupérer l'admin connecté
        $user = Auth::user();
    
        // Récupérer les alertes
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();
    
        // Filtrer les naissances selon la commune de l'admin connecté
        $deces = Deces::where('user_id', $user->id)->paginate(10); // Filtrage par commune
        $decesdeja = Decesdeja::where('user_id', $user->id)->paginate(10); // Filtrage par commune
       // Filtrage par commune
    
        // Retourner la vue avec les données
        return view('deces.userindex', compact('deces','decesdeja', 'alerts'));
    }
    public function agentindex(Request $request)
{
    // Récupérer l'admin connecté
    $admin = Auth::guard('agent')->user();

    // Récupérer les alertes
    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])  
        ->latest()
        ->get();

    // Construire la requête pour Deces en filtrant par commune
    $query = Deces::where('commune', $admin->communeM)
        ->where('agent_id', $admin->id); // Filtrage par agent
    $query = Decesdeja::where('commune', $admin->communeM)
        ->where('agent_id', $admin->id); // Filtrage par agent

    // Vérifier le type de recherche et appliquer le filtre
    if ($request->filled('searchType') && $request->filled('searchInput')) {
        if ($request->searchType === 'nomDefunt') {
            $query->where('nomDefunt', 'like', '%' . $request->searchInput . '%');
        } elseif ($request->searchType === 'nomHopital') {
            $query->where('nomHopital', 'like', '%' . $request->searchInput . '%');
        }
    }

    // Paginer les résultats
    $deces = $query->paginate(10);
    $decesdeja = $query->paginate(10);

    // Passer les données à la vue
    return view('deces.agentindex', compact('deces','decesdeja', 'alerts'));
}

    
public function ajointindex(Request $request)
{
     // Récupérer l'admin connecté
 $admin = Auth::guard('ajoint')->user();
 // Récupérer les alertes
 $alerts = Alert::where('is_read', false)
 ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
 ->latest()
 ->get();
  // Initialiser la requête pour Deces en filtrant par commune
  $query = Deces::where('commune', $admin->communeM); // Filtrer par commune
  $querys = Decesdeja::where('commune', $admin->communeM); // Filtrer par commune
  // Vérifier le type de recherche et appliquer le filtre
  if ($request->filled('searchType') && $request->filled('searchInput')) {
      if ($request->searchType === 'nomDefunt') {
          $query->where('nomDefunt', 'like', '%' . $request->searchInput . '%');
      } elseif ($request->searchType === 'nomHopital') {
          $query->where('nomHopital', 'like', '%' . $request->searchInput . '%');
      }
  }
  // Récupérer les résultats filtrés
  $deces = $query->get();
  $decesdeja = $querys->get();
  return view('deces.ajointindex', compact('deces','decesdeja','alerts'));
}
    


public function create(){
    return view('deces.create');
}


public function edit(Deces $deces){
    return view('deces.edit', compact('deces'));
}

public function store(saveDecesRequest $request)
{
    $imageBaseLink = '/images/deces/';

    // Liste des fichiers à traiter
    $filesToUpload = [
        'identiteDeclarant' => 'parent/',
        'acteMariage' => 'actemariage/',
        'deParLaLoi' => 'deparlaloi/', // Si ce fichier est soumis
    ];

    $uploadedPaths = []; // Contiendra les chemins des fichiers uploadés

    foreach ($filesToUpload as $fileKey => $subDir) {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $extension = $file->getClientOriginalExtension();
            $newFileName = (string) Str::uuid() . '.' . $extension;
            $file->storeAs("public/images/deces/$subDir", $newFileName);

            // Ajouter le chemin public à $uploadedPaths
            $uploadedPaths[$fileKey] = $imageBaseLink . "$subDir" . $newFileName;
        }
    }

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Enregistrement de l'objet Deces
    $deces = new Deces();
    $deces->nomHopital = $request->nomHopital;
    $deces->dateDces = $request->dateDces;
    $deces->nomDefunt = $request->nomDefunt;
    $deces->dateNaiss = $request->dateNaiss;
    $deces->lieuNaiss = $request->lieuNaiss;
    $deces->identiteDeclarant = $uploadedPaths['identiteDeclarant'] ?? null;
    $deces->acteMariage = $uploadedPaths['acteMariage'] ?? null;
    $deces->deParLaLoi = $uploadedPaths['deParLaLoi'] ?? null; // Si présent
    $deces->commune = $user->commune;
    $deces->etat = 'en attente';
    $deces->user_id = $user->id;  // Lier la demande à l'utilisateur connecté

    $deces->save();

    Alert::create([
        'type' => 'deces',
        'message' => "Une nouvelle demande d'extrait de décès a été enregistrée : {$deces->nomDefunt}.",
    ]);

    return redirect()->route('utilisateur.dashboard')->with('success', 'Votre demande a été traitée avec succès.');
}

public function show($id)
{
   // Récupérer les alertes
   $alerts = Alert::where('is_read', false)
   ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
   ->latest()
   ->get();
    $deces = Deces::with('user')->findOrFail($id); // Récupérer les données avec l'utilisateur
    return view('deces.details', compact('deces', 'alerts'));
}

public function createdeja(){
    return view('deces.createdeja');
}

public function storedeja(Request $request)
{
    $imageBaseLink = '/images/decesdeja/';

    // Liste des fichiers à traiter
    $filesToUpload = [
        'pActe' => 'acte', // Pas de sous-dossier
        'CNIdfnt' => 'cnid/', // Sous-dossier pour CNIdfnt
        'CNIdcl' => 'cnid/', // Sous-dossier pour CNIdcl
        'documentMariage' => 'mariage/', // Sous-dossier pour documentMariage
        'RequisPolice' => 'police/', // Sous-dossier pour RequisPolice
    ];

    $uploadedPaths = []; // Contiendra les chemins des fichiers uploadés

    foreach ($filesToUpload as $fileKey => $subDir) {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $extension = $file->getClientOriginalExtension();
            $newFileName = (string) Str::uuid() . '.' . $extension;

            // Stocker le fichier dans le bon sous-dossier
            $file->storeAs("public/images/decesdeja/$subDir", $newFileName);

            // Ajouter le chemin public à $uploadedPaths
            $uploadedPaths[$fileKey] = $imageBaseLink . "$subDir" . $newFileName;
        }
    }

    // Vérifier si l'utilisateur est authentifié
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Vous devez être connecté pour effectuer cette action.');
    }

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Enregistrement de l'objet Decesdeja
    $decesdeja = new Decesdeja();
    $decesdeja->name = $request->name;
    $decesdeja->numberR = $request->numberR;
    $decesdeja->dateR = $request->dateR;
    $decesdeja->CMU = $request->CMU;
    $decesdeja->pActe = $uploadedPaths['pActe'] ?? null; // Enregistrer le chemin de l'image si présente
    $decesdeja->CNIdfnt = $uploadedPaths['CNIdfnt'] ?? null;
    $decesdeja->CNIdcl = $uploadedPaths['CNIdcl'] ?? null;
    $decesdeja->documentMariage = $uploadedPaths['documentMariage'] ?? null;
    $decesdeja->RequisPolice = $uploadedPaths['RequisPolice'] ?? null;
    $decesdeja->commune = $request->communeD ?: $user->commune; // Déterminer la commune
    $decesdeja->etat = 'en attente';
    $decesdeja->user_id = $user->id; // Lier la demande à l'utilisateur connecté

    $decesdeja->save();

    return redirect()->route('utilisateur.dashboard')->with('success', 'Demande envoyée avec succès.');
}


}
