<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveNaissanceDRequest;
use App\Models\Alert;
use App\Models\NaissanceD;
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

    public function store(saveNaissanceDRequest $request)
    {

        $imageBaseLink = '/images/naissances/';
    
        $filesToUpload = [
            'CNI' => 'cni/', 
        ];
        
        $uploadedPaths = []; 
        
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
        
        // Vérifier si une commune est spécifiée dans la requête
        $commune = $request->has('commune') && !empty($request->commune) 
            ? $request->commune 
            : $user->commune;
    
        // Enregistrement de l'objet NaissanceD
        $naissanceD = new NaissanceD();
        $naissanceD->type = $request->type; 
        $naissanceD->pour = $request->pour; 
        $naissanceD->name = $request->name;
        $naissanceD->prenom = $request->prenom;
        $naissanceD->number = $request->number; 
        $naissanceD->DateR = $request->DateR; 
        $naissanceD->CNI = $uploadedPaths['CNI'] ?? null;
        $naissanceD->CMU = $request->CMU; 
        $naissanceD->commune = $commune;
        $naissanceD->etat = 'en attente'; 
        $naissanceD->is_read = false; 
        $naissanceD->user_id = $user->id;
    
        $naissanceD->save();
    
        Alert::create([
            'type' => 'naissance',
            'message' => "Une nouvelle demande d'extrait de naissance a été enregistrée : {$naissanceD->name}.",
        ]);
        
        return redirect()->route('utilisateur.index')->with('success', 'Votre demande a été enregistrée avec succès, Vous pouvez la voir dans la liste.');
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
