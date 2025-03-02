<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveMariageRequest;
use App\Models\Alert;
use App\Models\Mariage;
use App\Models\User;
use App\Services\InfobipService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MariageController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer l'admin connecté
        $admin = Auth::guard('vendor')->user();

         // Filtrer les naissances selon la commune de l'admin connecté
        $mariages = Mariage::where('commune', $admin->name)->paginate(10); // Filtrage par commune

        // Récupérer toutes les alertes
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();

        // Retourner la vue avec les mariages filtrés et les alertes
        return view('mariages.index', compact('mariages','alerts'));
    }

    public function superindex(){
        $mariages = Mariage::all();
        return view('mariages.superindex', compact('mariages'));
    }

    public function delete(Mariage $mariage)
    {
        try {
            $mariage->delete();
            return redirect()->route('mariage.userindex')->with('success', 'La demande a été supprimée avec succès.');
        } catch (Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de la suppression de la demande : ' . $e->getMessage());
            // Rediriger avec un message d'erreur
            return redirect()->route('mariage.userindex')->with('error1', 'Une erreur est survenue lors de la suppression de la demande.');
        }
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
                  ->orWhere('nomEpouse', 'like', '%' . $request->searchInput . '%'); 
        } elseif ($request->searchType === 'prenomConjoint') {
            $query->where('prenomEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('prenomEpouse', 'like', '%' . $request->searchInput . '%'); 
        } elseif ($request->searchType === 'lieuNaissance') {
            $query->where('lieuNaissanceEpoux', 'like', '%' . $request->searchInput . '%')
                  ->orWhere('lieuNaissanceEpouse', 'like', '%' . $request->searchInput . '%'); 
        }
    }

    // Récupérer tous les mariages correspondant aux critères de filtrage
    $mariages = $query->get();

    // Fusionner les deux collections en une seule
    $allMariages = $mariages;

    // Récupérer toutes les alertes
    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();

    // Retourner la vue avec les mariages fusionnés et les alertes
    return view('mariages.userindex', compact('allMariages', 'alerts'));
}

public function agentindex(Request $request)
{
    // Récupérer l'admin connecté
    $admin = Auth::guard('agent')->user();

    // Initialiser la requête pour Mariage et filtrer par commune de l'admin
    $query = Mariage::where('commune', $admin->communeM)
        ->where('agent_id', $admin->id)
        ->with('user'); // Ajout de la récupération de la relation 'user'

    // Vérifier le type de recherche et appliquer le filtre
    if ($request->filled('searchType') && $request->filled('searchInput')) {
        if ($request->searchType === 'nomConjoint') {
            $query->where(function($q) use ($request) {
                $q->where('nomEpoux', 'like', '%' . $request->searchInput . '%')
                    ->orWhere('nomEpouse', 'like', '%' . $request->searchInput . '%');
            });
        } elseif ($request->searchType === 'prenomConjoint') {
            $query->where(function($q) use ($request) {
               $q->where('prenomEpoux', 'like', '%' . $request->searchInput . '%')
                   ->orWhere('prenomEpouse', 'like', '%' . $request->searchInput . '%');
            });
        } elseif ($request->searchType === 'lieuNaissance') {
            $query->where(function($q) use ($request) {
                $q->where('lieuNaissanceEpoux', 'like', '%' . $request->searchInput . '%')
                    ->orWhere('lieuNaissanceEpouse', 'like', '%' . $request->searchInput . '%');
            });
        }
    }
    
    // Récupérer tous les mariages correspondant aux critères de filtrage
    $mariages = $query->paginate(10);

    // Récupérer toutes les alertes
    $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'naissanceD', 'mariage', 'deces', 'decesHop', 'naissHop'])
        ->latest()
        ->get();

    // Retourner la vue avec les mariages filtrés et les alertes
    return view('mariages.agentindex', compact('mariages', 'alerts'));
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
   
    public function store(saveMariageRequest $request, InfobipService $infobipService)
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

        // Générer la référence ici dans le contrôleur
        $communeInitiale = strtoupper(substr($commune ?: 'X', 0, 1)); // 'X' si commune est null ou vide
        $anneeCourante = Carbon::now()->year;
        $reference = 'AM' . str_pad(Mariage::getNextId(), 4, '0', STR_PAD_LEFT) . $communeInitiale . $anneeCourante; // AM pour Acte de Mariage


        // Enregistrement de l'objet Mariage
        $mariage = new Mariage();
        $mariage->nomEpoux = $request->nomEpoux;
        $mariage->prenomEpoux = $request->prenomEpoux;
        $mariage->dateNaissanceEpoux = $request->dateNaissanceEpoux;
        $mariage->lieuNaissanceEpoux = $request->lieuNaissanceEpoux;
        $mariage->pieceIdentite = $uploadedPaths['pieceIdentite'] ?? null;
        $mariage->extraitMariage = $uploadedPaths['extraitMariage'] ?? null;
        $mariage->commune = $commune; // Utilisation de la commune spécifiée
        $mariage->choix_option = $request->choix_option;
        $mariage->CMU = $request->CMU;
        $mariage->etat = 'en attente';
        $mariage->user_id = $user->id;  // Lier la demande à l'utilisateur connecté
        $mariage->reference = $reference; // Assignez la référence générée


        if ($request->input('choix_option') === 'livraison') {
            $mariage->montant_timbre = $request->input('montant_timbre');
            $mariage->montant_livraison = $request->input('montant_livraison');
            $mariage->nom_destinataire = $request->input('nom_destinataire');
            $mariage->prenom_destinataire = $request->input('prenom_destinataire');
            $mariage->email_destinataire = $request->input('email_destinataire');
            $mariage->contact_destinataire = $request->input('contact_destinataire');
            $mariage->adresse_livraison = $request->input('adresse_livraison');
            $mariage->code_postal = $request->input('code_postal');
            $mariage->ville = $request->input('ville');
            $mariage->commune_livraison = $request->input('commune_livraison');
            $mariage->quartier = $request->input('quartier');
        }

        $mariage->save();
        $phoneNumber = $user->indicatif . $user->contact;
        $message = "Bonjour {$user->name}, votre demande d'extrait de mariage a bien été transmise à la mairie de {$user->commune}. Référence: {$mariage->reference}.";
        $infobipService->sendSms($phoneNumber, $message);

        Alert::create([
            'type' => 'mariage',
            'message' => "Une nouvelle demande d'extrait de mariage a été enregistrée : {$mariage->nomEpoux} {$mariage->prenomEpoux}.",
        ]);

        return redirect()->route('mariage.userindex')->with('success', 'Votre demande a été traitée avec succès.');
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
