<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveNaissanceRequest;
use App\Models\Alert;
use App\Models\Deces;
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
    public function index(){
       
        $alerts = Alert::all();
        $naissances = Naissance::paginate(10);
        $naissancesD = NaissanceD::paginate(10);
        return view('naissances.index', compact('naissances', 'alerts','naissancesD') );
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
    
        // Récupérer la commune de l'utilisateur connecté
        $user = Auth::user();
        $userCommune = $user->commune;
    
        // Enregistrement de l'objet Naissance
        $naissance = new Naissance();
        $naissance->nomHopital = $request->nomHopital;
        $naissance->nomDefunt = $request->nomDefunt;
        $naissance->dateNaiss = $request->dateNaiss;
        $naissance->lieuNaiss = $request->lieuNaiss;
    
        // Ajouter les fichiers uploadés à l'objet si disponibles
        $naissance->identiteDeclarant = $uploadedPaths['identiteDeclarant'] ?? null;
        $naissance->cdnaiss = $uploadedPaths['cdnaiss'] ?? null;
        $naissance->acteMariage = $uploadedPaths['acteMariage'] ?? null;
    
        // Associer la commune (via le champ `commune`)
        $naissance->commune = $userCommune;
        $naissance->etat = 'En entente';
    
        $naissance->save();
        Alert::create([
            'type' => 'naissance',
            'message' => "Une nouvelle demande d'extrait de naissance a été enregistrée : {$naissance->nomDefunt}.",
        ]);
    
        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Votre demande a été traitée avec succès.');
    }

    public function show($id)
{
    $alerts = Alert::all();
    $naissance = Naissance::findOrFail($id); // Récupérer les données ou générer une erreur 404 si non trouvé
    return view('naissances.details', compact('naissance','alerts'));
}
    

}
