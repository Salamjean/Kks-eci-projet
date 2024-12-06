<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDecesRequest;
use App\Models\Alert;
use App\Models\Deces;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DecesController extends Controller
{
    public function index(Request $request)
    {   
        $alerts = Alert::all();
        $query = Deces::query();
    
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

public function store(SaveDecesRequest $request)
{
    $imageBaseLink = '/images/deces/';

    // Liste des fichiers à traiter
    $filesToUpload = [
        'identiteDeclarant' => 'declarant/',
        'acteMariage' => 'mariage/',
        'deParLaLoi' => 'loi/',
    ];

    $uploadedPaths = []; // Contiendra les chemins des fichiers uploadés

    // Upload des fichiers
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

    // Enregistrement de l'objet Décès
    try {
        $deces = new Deces();
        $deces->nomHopital = $request->nomHopital;
        $deces->dateDces = $request->dateDces;
        $deces->nomDefunt = $request->nomDefunt;
        $deces->dateNaiss = $request->dateNaiss;
        $deces->lieuNaiss = $request->lieuNaiss;

        // Ajouter les fichiers uploadés à l'objet si disponibles
        $deces->identiteDeclarant = $uploadedPaths['identiteDeclarant'] ?? null;
        $deces->acteMariage = $uploadedPaths['acteMariage'] ?? null;
        $deces->deParLaLoi = $uploadedPaths['deParLaLoi'] ?? null;

        $deces->save();
        Alert::create([
            'type' => 'deces',
            'message' => "Une nouvelle demande d'extrait de décès a été enregistrée : {$deces->nomDefunt}.",
        ]);

        // Redirection avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Déclaration de décès enregistrée avec succès.');
    } catch (Exception $e) {
        // Gérer les erreurs
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}


}
