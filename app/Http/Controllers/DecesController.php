<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDecesRequest;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Services\InfobipService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DecesController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer l'admin connecté
        $admin = Auth::guard('vendor')->user();

        // Récupérer les alertes
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])
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

        return view('deces.index', compact('deces', 'decesdeja', 'alerts'));
    }

    public function superindex(Request $request)
    {
        // Récupérer les alertes
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])
            ->latest()
            ->get();

        // Initialiser la requête pour Deces en filtrant par commune
        $deces = Deces::all();
        $decesdeja = Decesdeja::all();
        return view('deces.superindex', compact('deces', 'decesdeja', 'alerts'));
    }


    public function userindex()
    {
        // Récupérer l'admin connecté
        $user = Auth::user();

        // Récupérer les alertes
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])
            ->latest()
            ->get();

        // Filtrer les naissances selon la commune de l'admin connecté
        $deces = Deces::where('user_id', $user->id)->paginate(10); // Filtrage par commune
        $decesdeja = Decesdeja::where('user_id', $user->id)->paginate(10); // Filtrage par commune
        // Filtrage par commune

        // Retourner la vue avec les données
        return view('deces.userindex', compact('deces', 'decesdeja', 'alerts'));
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

        // Requête pour Deces
        $decesQuery = Deces::where('commune', $admin->communeM)
            ->where('agent_id', $admin->id)
            ->with('user'); // Filtrage par agent et récupération des relations

        // Requête pour Decesdeja
        $decesdejaQuery = Decesdeja::where('commune', $admin->communeM)
            ->where('agent_id', $admin->id)
            ->with('user'); // Filtrage par agent et récupération des relations

        // Appliquer les filtres de recherche pour Deces
        if ($request->filled('searchType') && $request->filled('searchInput')) {
            if ($request->searchType === 'nomDefunt') {
                $decesQuery->where('nomDefunt', 'like', '%' . $request->searchInput . '%');
            } elseif ($request->searchType === 'nomHopital') {
                $decesQuery->where('nomHopital', 'like', '%' . $request->searchInput . '%');
            }
        }

        // Appliquer les filtres de recherche pour Decesdeja
        if ($request->filled('searchType') && $request->filled('searchInput')) {
            if ($request->searchType === 'nomDefunt') {
                $decesdejaQuery->where('nomDefunt', 'like', '%' . $request->searchInput . '%');
            } elseif ($request->searchType === 'nomHopital') {
                $decesdejaQuery->where('nomHopital', 'like', '%' . $request->searchInput . '%');
            }
        }

        // Paginer les résultats
        $deces = $decesQuery->paginate(10);
        $decesdeja = $decesdejaQuery->paginate(10);

        // Passer les données à la vue
        return view('deces.agentindex', compact('deces', 'decesdeja', 'alerts'));
    }


    public function ajointindex(Request $request)
    {
        // Récupérer l'admin connecté
        $admin = Auth::guard('ajoint')->user();
        // Récupérer les alertes
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])
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
        return view('deces.ajointindex', compact('deces', 'decesdeja', 'alerts'));
    }

    public function delete(Deces $deces)
    {
        try {
            $deces->delete();
            return redirect()->route('decesutilisateur.index')->with('success', 'La demande a été supprimée avec succès.');
        } catch (Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de la suppression de la demande : ' . $e->getMessage());
            // Rediriger avec un message d'erreur
            return redirect()->route('decesutilisateur.index')->with('error', 'Une erreur est survenue lors de la suppression de la demande.');
        }
    }



    public function create()
    {
        return view('deces.create');
    }


    public function edit(Deces $deces)
    {
        return view('deces.edit', compact('deces'));
    }

    public function store(saveDecesRequest $request, InfobipService $infobipService)
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

        // Générer la référence ici dans le contrôleur
        $communeInitiale = strtoupper(substr($user->commune ?? 'X', 0, 1)); // 'X' si commune est null ou vide
        $anneeCourante = Carbon::now()->year;
        $reference = 'AD' . str_pad(Deces::getNextId(), 4, '0', STR_PAD_LEFT) . $communeInitiale . $anneeCourante; // AD pour Acte de Decès


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
        $deces->choix_option = $request->choix_option;
        $deces->commune = $user->commune;
        $deces->etat = 'en attente';
        $deces->user_id = $user->id;  // Lier la demande à l'utilisateur connecté
        $deces->reference = $reference; // Assignez la référence générée

           // Ajout des informations de livraison si option livraison est choisie
        if ($request->input('choix_option') === 'livraison') {
            $deces->montant_timbre = $request->input('montant_timbre');
            $deces->montant_livraison = $request->input('montant_livraison');
            $deces->nom_destinataire = $request->input('nom_destinataire');
            $deces->prenom_destinataire = $request->input('prenom_destinataire');
            $deces->email_destinataire = $request->input('email_destinataire');
            $deces->contact_destinataire = $request->input('contact_destinataire');
            $deces->adresse_livraison = $request->input('adresse_livraison');
            $deces->code_postal = $request->input('code_postal');
            $deces->ville = $request->input('ville');
            $deces->commune_livraison = $request->input('commune_livraison');
            $deces->quartier = $request->input('quartier');
        }

        $deces->save();

        $message = "Bonjour {$user->name}, votre demande d'extrait de décès a bien été transmise à la mairie de {$user->commune}. Référence: {$deces->reference}.";
        $infobipService->sendSms(+2250798278981, $message);
        Alert::create([
            'type' => 'deces',
            'message' => "Une nouvelle demande d'extrait de décès a été enregistrée : {$deces->nomDefunt}.",
        ]);

        return redirect()->route('decesutilisateur.index')->with('success', 'Votre demande a été traitée avec succès.');
    }
    public function show($id)
    {
        // Récupérer les alertes
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces', 'decesHop', 'naissHop'])
            ->latest()
            ->get();
        $deces = Deces::with('user')->findOrFail($id); // Récupérer les données avec l'utilisateur
        return view('deces.details', compact('deces', 'alerts'));
    }

    public function createdeja()
    {
        return view('deces.createdeja');
    }

    public function storedeja(Request $request, InfobipService $infobipService)
    {
        $request->validate([
            'name' => 'required',
            'numberR' => 'required',
            'dateR' => 'required',
            'CMU' => 'required',
            'pActe' => 'required|mimes:png,jpg,jpeg,pdf|max:1000',
            'CNIdfnt' => 'required|mimes:png,jpg,jpeg,pdf|max:1000',
            'CNIdcl' => 'required|mimes:png,jpg,jpeg,pdf|max:1000',
        ],[
            'name.required' => 'Le nom du défunt est obligatoire.',
            'numberR.required' => 'Le numéro de l\'acte de décès est obligatoire.',
            'dateR.required' => 'La date de l\'acte de décès est obligatoire.',
            'CMU.required' => 'Le CMU est obligatoire.',
            'pActe.required' => 'Le document acte de décès est obligatoire.',
            'CNIdfnt.required' => 'Le document CNIdfnt est obligatoire.',
            'CNIdcl.required' => 'Le document CNIdcl est obligatoire.',
            'documentMariage.required' => 'Le document du document de mariage est obligatoire.',
            'RequisPolice.required' => 'Le document requis de police est obligatoire.',
            'pActe.mimes' => 'Le document acte de décès doit être un format de fichier valide (png, jpg, jpeg, pdf).',
            'CNIdfnt.mimes' => 'Le document CNIdfnt doit être un format de fichier valide (png, jpg, jpeg, pdf).',
        ]);

        $imageBaseLink = '/images/decesdeja/';

        // Liste des fichiers à traiter
        $filesToUpload = [
            'pActe' => '', // Pas de sous-dossier
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

        // Générer la référence ici dans le contrôleur
        $communeInitiale = strtoupper(substr($request->communeD ?: $user->commune ?: 'X', 0, 1)); // 'X' si commune est null ou vide (prend communeD du request si existe sinon commune user sinon X)
        $anneeCourante = Carbon::now()->year;
        $reference = 'ADJ' . str_pad(Decesdeja::getNextId(), 4, '0', STR_PAD_LEFT) . $communeInitiale . $anneeCourante; // ADJ pour Acte de Decès Déjà Jugé


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
        $decesdeja->choix_option = $request->choix_option;
        $decesdeja->commune = $request->communeD ?: $user->commune; // Déterminer la commune
        $decesdeja->etat = 'en attente';
        $decesdeja->user_id = $user->id; // Lier la demande à l'utilisateur connecté
        $decesdeja->reference = $reference; // Assignez la référence générée

           // Ajout des informations de livraison si option livraison est choisie
        if ($request->input('choix_option') === 'livraison') {
            $decesdeja->montant_timbre = $request->input('montant_timbre');
            $decesdeja->montant_livraison = $request->input('montant_livraison');
            $decesdeja->nom_destinataire = $request->input('nom_destinataire');
            $decesdeja->prenom_destinataire = $request->input('prenom_destinataire');
            $decesdeja->email_destinataire = $request->input('email_destinataire');
            $decesdeja->contact_destinataire = $request->input('contact_destinataire');
            $decesdeja->adresse_livraison = $request->input('adresse_livraison');
            $decesdeja->code_postal = $request->input('code_postal');
            $decesdeja->ville = $request->input('ville');
            $decesdeja->commune_livraison = $request->input('commune_livraison');
            $decesdeja->quartier = $request->input('quartier');
        }

        $decesdeja->save();

        $message = "Bonjour {$user->name}, votre demande d'extrait de décès a bien été transmise à la mairie de {$user->commune}. Référence: {$decesdeja->reference}.";
        $infobipService->sendSms(+2250798278981, $message);

        return redirect()->route('decesutilisateur.index')->with('success', 'Demande envoyée avec succès.');
    }
    public function deletedeja(Decesdeja $decesdeja)
    {
        try {
            $decesdeja->delete();
            return redirect()->route('decesutilisateur.index')->with('success', 'La demande a été supprimée avec succès.');
        } catch (Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de la suppression de la demande : ' . $e->getMessage());

            // Rediriger avec un message d'erreur
            return redirect()->route('decesutilisateur.index')->with('error', 'Une erreur est survenue lors de la suppression de la demande.');
        }
    }
}
