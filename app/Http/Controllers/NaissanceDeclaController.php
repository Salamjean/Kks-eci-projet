<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveNaissanceDRequest;
use App\Models\Alert;
use App\Models\NaissanceD;
use App\Services\InfobipService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NaissanceDeclaController extends Controller
{
    public function create()
    {
        // Récupère l'utilisateur authentifié
        $userConnecté = Auth::user();

        // Renvoie la vue avec les données de l'utilisateur
        return view('naissanceD.create', [
            'userName' => $userConnecté ? $userConnecté->name : '', 
            'userPrenom' => $userConnecté ? $userConnecté->prenom : '', 
            'userCommune' => $userConnecté ? $userConnecté->commune : '', 
            'userCMU' => $userConnecté ? $userConnecté->CMU : '', 
        ]);
    }
    public function index(){
        
        return view('naissanceD.index');
    }

    public function store(SaveNaissancedRequest $request, InfobipService $infobipService)
{
    // Log des données de la requête
    Log::info('Store method called', $request->all());

    // Configuration des chemins pour le stockage des fichiers
    $imageBaseLink = '/images/naissanceds/';
    $filesToUpload = [
        'CNI' => 'cni/',
    ];
    $uploadedPaths = [];

    // Traitement des fichiers uploadés
    foreach ($filesToUpload as $fileKey => $subDir) {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $extension = $file->getClientOriginalExtension();
            $newFileName = (string) Str::uuid() . '.' . $extension;
            $file->storeAs("public/images/naissanceds/$subDir", $newFileName);
            $uploadedPaths[$fileKey] = $imageBaseLink . "$subDir" . $newFileName;
        }
    }

    // Récupération de l'utilisateur connecté
    $user = Auth::user();

    // Génération de la référence
    $communeInitiale = strtoupper(substr($user->commune ?? 'X', 0, 1)); // 'X' si commune est null ou vide
    $anneeCourante = Carbon::now()->year;
    $reference = 'ANJ' . str_pad(Naissanced::getNextId(), 4, '0', STR_PAD_LEFT) . $communeInitiale . $anneeCourante;

    // Création de la demande d'extrait de naissance
    $naissanced = new Naissanced();
    $naissanced->pour = $request->pour;
    $naissanced->type = $request->type;
    $naissanced->name = $request->name;
    $naissanced->prenom = $request->prenom;
    $naissanced->number = $request->number;
    $naissanced->DateR = $request->DateR;
    $naissanced->commune = $request->commune;
    $naissanced->CNI = $uploadedPaths['CNI'] ?? null;
    $naissanced->CMU = $request->CMU;
    $naissanced->choix_option = $request->choix_option;
    $naissanced->user_id = $user->id;
    $naissanced->etat = 'en attente';
    $naissanced->reference = $reference;

    // Ajout des informations de livraison si l'option "livraison" est choisie
    if ($request->input('choix_option') === 'livraison') {
        $naissanced->montant_timbre = $request->input('montant_timbre');
        $naissanced->montant_livraison = $request->input('montant_livraison');
        $naissanced->nom_destinataire = $request->input('nom_destinataire');
        $naissanced->prenom_destinataire = $request->input('prenom_destinataire');
        $naissanced->email_destinataire = $request->input('email_destinataire');
        $naissanced->contact_destinataire = $request->input('contact_destinataire');
        $naissanced->adresse_livraison = $request->input('adresse_livraison');
        $naissanced->code_postal = $request->input('code_postal');
        $naissanced->ville = $request->input('ville');
        $naissanced->commune_livraison = $request->input('commune_livraison');
        $naissanced->quartier = $request->input('quartier');
    }

    // Sauvegarde de la demande
    $naissanced->save();
    Log::info('Données de l\'utilisateur : ', [
        'indicatif' => $user->indicatif,
        'contact' => $user->contact,
    ]);

    // Construction du numéro de téléphone
    $phoneNumber = $user->indicatif . $user->contact;
    Log::info('Numéro de téléphone construit : ' . $phoneNumber);

    // Envoi du SMS
    $message = "Bonjour {$user->name}, votre demande d'extrait de naissance a bien été transmise à la mairie de {$user->commune}. Référence : {$naissanced->reference}.
Vous pouvez suivre l'état de votre demande en cliquant sur ce lien : https://edemarchee-ci.com/E-ci-recherche/demande";
    $smsResult = $infobipService->sendSms($phoneNumber, $message);

    // Log du résultat de l'envoi du SMS
    if ($smsResult === false) {
        Log::error('Échec de l\'envoi du SMS à : ' . $phoneNumber);
    } else {
        Log::info('SMS envoyé avec succès à : ' . $phoneNumber);
    }

    // Création d'une alerte
    Alert::create([
        'type' => 'extrait_naissance',
        'message' => "Une nouvelle demande d'extrait de naissance a été enregistrée : {$naissanced->name} {$naissanced->prenom}.",
    ]);

    // Redirection avec un message de succès
    return redirect()->route('utilisateur.index')->with('success', 'Votre demande a été traitée avec succès.');
}
    public function delete(NaissanceD $naissanceD)
    {
        try {
            $naissanceD->delete();
            return redirect()->route('utilisateur.index')->with('success', 'La demande a été supprimée avec succès.');
        } catch (Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de la suppression de la demande : ' . $e->getMessage());
            // Rediriger avec un message d'erreur
            return redirect()->route('utilisateur.index')->with('error1', 'Une erreur est survenue lors de la suppression de la demande.');
        }
    }
    

    public function show($id)
    {
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();
        $naissanced = NaissanceD::with('user')->findOrFail($id); // Récupérer les données avec l'utilisateur
        return view('naissanceD.details', compact('naissanced', 'alerts'));
    }
    


}
