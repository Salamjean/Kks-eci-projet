<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDecesRequest;
use App\Models\Alert;
use App\Models\Deces;
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
        $alerts = Alert::all();
    
        // Initialiser la requête pour Deces en filtrant par commune
        $query = Deces::where('commune', $admin->name); // Filtrer par commune
    
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
    
        return view('deces.index', compact('deces','alerts'));
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

    return redirect()->back()->with('success', 'Votre demande a été traitée avec succès.');
}

public function show($id)
{
    $alerts = Alert::all();
    $deces = Deces::with('user')->findOrFail($id); // Récupérer les données avec l'utilisateur
    return view('deces.details', compact('deces', 'alerts'));
}


}
