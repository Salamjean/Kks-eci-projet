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
    public function agentindex(Request $request)
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
    
        return view('deces.agentindex', compact('deces','alerts'));
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

    // Vérifier si l'utilisateur est authentifié
    if (!Auth::check()) {
        return redirect()->back()->with('error', 'Vous devez être connecté pour effectuer cette action.');
    }

    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Validation des données
    $request->validate([
        'name' => 'required',
        'numberR' => 'required',
        'dateR' => 'required',
        'CMD' => 'required',
        'pActe' => 'image|mimes:png,jpg,jpeg|max:300',
    ], [
        'name.required' => 'Veuillez renseigner le nom du défunt',
        'numberR.required' => 'Veuillez renseigner le numéro de registre',
        'dateR.required' => 'Veuillez renseigner la date de registre',
        'CMD.required' => 'Veuillez renseigner le code de secours',
        'pActe.image' => 'Le fichier doit être une image',
        'pActe.mimes' => 'Le format de l\'image doit être PNG, JPG ou JPEG',
        'pActe.max' => 'L\'image ne doit pas dépasser 300 Ko',
    ]);

    // Traitement du fichier pActe s'il est présent
    $uploadedPath = null;
    if ($request->hasFile('pActe')) {
        $file = $request->file('pActe');
        $extension = $file->getClientOriginalExtension();
        $newFileName = (string) Str::uuid() . '.' . $extension;

        // Assurez-vous que le dossier existe avant de stocker le fichier
        $file->storeAs('public/images/decesdeja/', $newFileName);
        $uploadedPath = $imageBaseLink . $newFileName;
    }

    try {
        // Enregistrement des données
        $decesdeja = new Decesdeja();
        $decesdeja->name = $request->name;
        $decesdeja->numberR = $request->numberR;
        $decesdeja->dateR = $request->dateR;
        $decesdeja->CMD = $request->CMD;
        $decesdeja->pActe = $uploadedPath; // Enregistrer le chemin de l'image si présente
        $decesdeja->commune = $user->commune;
        $decesdeja->etat = 'en attente';
        $decesdeja->user_id = $user->id;
        $decesdeja->save();

        return redirect()->back()->with('success', 'Demande envoyée avec succès');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
    }
}




}
