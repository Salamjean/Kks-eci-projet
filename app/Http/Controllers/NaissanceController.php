<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveNaissanceRequest;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\Image;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\NaissHop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function Pest\Laravel\post;

class NaissanceController extends Controller
{
    public function index()
    {
        // Récupérer l'admin connecté
        $admin = Auth::guard('vendor')->user();
    
        // Récupérer les alertes
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();
    
        // Filtrer les naissances selon la commune de l'admin connecté
        $naissances = Naissance::where('commune', $admin->name)->paginate(10); // Filtrage par commune
        $naissancesD = NaissanceD::where('commune', $admin->name)->paginate(10); // Filtrage par commune
    
        // Retourner la vue avec les données
        return view('naissances.index', compact('naissances', 'alerts', 'naissancesD'));
    }
    public function userindex()
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Récupérer les alertes pour l'utilisateur
    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])  
        ->latest()
        ->get();

    // Filtrer les naissances selon l'ID de l'utilisateur connecté
    $naissances = Naissance::where('user_id', $user->id)->paginate(10);
    $naissancesD = NaissanceD::where('user_id', $user->id)->paginate(10);

    // Retourner la vue avec les données
    return view('naissances.userindex', compact('naissances', 'alerts', 'naissancesD'));
}

    public function agentindex()
{
    // Récupérer l'admin connecté
    $admin = Auth::guard('agent')->user();

    // Récupérer les alertes
    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])  
        ->latest()
        ->get();

    // Filtrer les naissances selon la commune de l'admin connecté
    // et l'agent connecté pour les demandes traitées par cet agent
    $naissances = Naissance::where('commune', $admin->communeM)
        ->where('agent_id', $admin->id) // Filtrage par agent
        ->paginate(10); // Pagination

    $naissancesD = NaissanceD::where('commune', $admin->communeM)
        ->where('agent_id', $admin->id) // Filtrage par agent
        ->paginate(10); // Pagination

    // Retourner la vue avec les données
    return view('naissances.agentindex', compact('naissances', 'alerts', 'naissancesD'));
}

public function ajointindex()
{
    // Récupérer l'admin connecté
    $admin = Auth::guard('ajoint')->user();

    // Récupérer les alertes
    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])  
        ->latest()
        ->get();

    // Filtrer les naissances selon la commune de l'admin connecté
    // et l'agent connecté pour les demandes traitées par cet agent
    $naissances = Naissance::where('commune', $admin->communeM)
        ->paginate(10); // Pagination

    $naissancesD = NaissanceD::where('commune', $admin->communeM)
        ->paginate(10); // Pagination

    // Retourner la vue avec les données
    return view('naissances.ajointindex', compact('naissances', 'alerts', 'naissancesD'));
}

    public function traiterDemande($id)
{
    $agent = Auth::guard('agent')->user();

    // Essayer de trouver une demande de naissance
    $naissance = Naissance::find($id);
    if ($naissance) {
        $naissance->is_read = true; // Marquer comme traité
        $naissance->agent_id = $agent->id; // Enregistrer l'ID de l'agent
        $naissance->save();

        return redirect()->route('naissance.agentindex')->with('success', 'Demande de naissance traitée avec succès.');
    }

    $agent = Auth::guard('agent')->user();
    // Essayer de trouver une demande de naissanceD
    $naissanceD = NaissanceD::find($id);
    if ($naissanceD) {
        $naissanceD->is_read = true; // Marquer comme traité
        $naissanceD->agent_id = $agent->id; // Enregistrer l'ID de l'agent
        $naissanceD->save();

        return redirect()->route('naissance.agentindex')->with('success', 'Demande de naissanceD traitée avec succès.');
    }

    // Si aucune demande n'est trouvée
    return redirect()->route('naissance.agentindex')->with('error', 'Demande introuvable.');
}


    public function traiterDemandeDeces($id)
{
    $agent = Auth::guard('agent')->user();
    // Essayer de trouver une demande de deces
    $deces = Deces::find($id);
    if ($deces) {
        $deces->is_read = true; // Marquer comme traité
        $deces->agent_id = $agent->id; // Enregistrer l'ID de l'agent
        $deces->save();

        return redirect()->route('deces.agentindex')->with('success', 'Demande de deces traitée avec succès.');
    }

    $agent = Auth::guard('agent')->user();
    // Essayer de trouver une demande de naissanceD
    $decesdeja = Decesdeja::find($id);
    if ($decesdeja) {
        $decesdeja->is_read = true; // Marquer comme traité
        $decesdeja->agent_id = $agent->id; // Enregistrer l'ID de l'agent
        $decesdeja->save();
        return redirect()->route('deces.agentindex')->with('success', 'Demande de decesdeja traitée avec succès.');
    }

    
    // Si aucune demande n'est trouvée
    return redirect()->route('deces.agentindex')->with('error', 'Demande introuvable.');
}



    public function traiterDemandeMariage($id)
{
    $agent = Auth::guard('agent')->user();
    // Essayer de trouver une demande de mariage
    $mariage = Mariage::find($id);
    if ($mariage) {
        $mariage->is_read = true; // Marquer comme traité
        $mariage->agent_id = $agent->id; // Enregistrer l'ID de l'agent
        $mariage->save();

        return redirect()->route('mariage.agentindex')->with('success', 'Demande de mariage traitée avec succès.');
    }
    // Si aucune demande n'est trouvée
    return redirect()->route('mariage.agentindex')->with('error', 'Demande introuvable.');
}


    public function create(){
        $naisshop = NaissHop::all();
        return view('naissances.create', compact('naisshop'));
    }


    public function edit(Naissance $naissance){
        return view('naissances.edit', compact('naissance'));
    }


    public function store(saveNaissanceRequest $request)
{
    $imageBaseLink = '/images/naissances/';
    
    // Liste des fichiers à traiter
    $filesToUpload = [
        'identiteDeclarant' => 'parent/',
        'cdnaiss' => 'cdn/',
        'acteMariage' => 'actemariage/',
    ];
    
    $uploadedPaths = []; // Contiendra les chemins des fichiers uploadés
    
    foreach ($filesToUpload as $fileKey => $subDir) {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $extension = $file->getClientOriginalExtension();
            $newFileName = (string) Str::uuid() . '.' . $extension;
            $file->storeAs("public/images/naissances/$subDir", $newFileName);
    
            // Ajouter le chemin public à $uploadedPaths
            $uploadedPaths[$fileKey] = $imageBaseLink . "$subDir" . $newFileName;
        }
    }
    
    // Récupérer l'utilisateur connecté
    $user = Auth::user();
    
    // Enregistrement de l'objet Naissance
    $naissance = new Naissance();
    $naissance->nomHopital = $request->nomHopital;
    $naissance->nomDefunt = $request->nomDefunt;
    $naissance->dateNaiss = $request->dateNaiss;
    $naissance->lieuNaiss = $request->lieuNaiss;
    $naissance->identiteDeclarant = $uploadedPaths['identiteDeclarant'] ?? null;
    $naissance->cdnaiss = $uploadedPaths['cdnaiss'] ?? null;
    $naissance->acteMariage = $uploadedPaths['acteMariage'] ?? null;
    $naissance->commune = $user->commune;
    $naissance->nom = $request->nom;
    $naissance->prenom = $request->prenom;
    $naissance->nompere = $request->nompere;
    $naissance->prenompere = $request->prenompere;
    $naissance->datepere = $request->datepere;
    $naissance->etat = 'en attente';
    $naissance->user_id = $user->id;  // Lier la demande à l'utilisateur connecté
    
    $naissance->save();
    Alert::create([
        'type' => 'naissance',
        'message' => "Une nouvelle demande d'extrait de naissance a été enregistrée : {$naissance->nomDefunt}.",
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
    $naissance = Naissance::with('user')->findOrFail($id); // Récupérer les données avec l'utilisateur
    return view('naissances.details', compact('naissance', 'alerts'));
}

public function showEtat($id)
{
   // Récupérer les alertes
   $alerts = Alert::where('is_read', false)
   ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
   ->latest()
   ->get();
    $naissance = Naissance::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    
    // Retourner la vue avec les informations
    return view('naissances.detailsEtat', compact('naissance', 'alerts'));
}

    

}
