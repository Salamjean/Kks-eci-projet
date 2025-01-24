<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNaissHopRequest;
use App\Models\Alert;
use App\Models\DecesHop;
use App\Models\Doctor;
use App\Models\NaissHop;
use App\Models\SousAdmin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use writeFile;
use PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class NaissHopController extends Controller
{
    public function create(){
        $doctor = Doctor::all();
        return view('naissHop.create', compact('doctor'));
    }
    public function index() {
        // Récupérer l'administrateur connecté
        $sousadmin = Auth::guard('sous_admin')->user();
        
        // Récupérer la commune de l'administrateur
        $communeAdmin = $sousadmin->nomHop;
        $sousAdminId = $sousadmin->id; // Récupérer l'ID du sous-administrateur
    
        // Récupérer les déclarations de naissances filtrées par la commune de l'administrateur et l'ID du sous-administrateur
        $naisshops = NaissHop::where('NomEnf', $communeAdmin)
            ->where('sous_admin_id', $sousAdminId) // Filtrer par ID de sous-administrateur
            ->get();
    
        return view('naissHop.index', ['naisshops' => $naisshops]);
    }

    public function directeurindex() {
        // Récupérer l'administrateur connecté
        $directeur = Auth::guard('directeur')->user();
        
        // Récupérer la commune de l'administrateur
        $communeAdmin = $directeur->nomHop;
        
        // Récupérer les déclarations de naissances filtrées par la commune de l'administrateur 
        $naisshops = NaissHop::where('NomEnf', $communeAdmin)->get();
        
        return view('naissHop.directeurindex', ['naisshops' => $naisshops]);
    }

    public function superindex() {
        
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
            ->latest()
            ->get();
        $naisshops = NaissHop::all();
        return view('naissHop.superindex', compact('naisshops','alerts'));
    }
    public function mairieindex() {
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
            ->latest()
            ->get();
        $sousadmin = Auth::guard('vendor')->user();
        
        // Récupérer la commune de l'administrateur
        $communeAdmin = $sousadmin->name; // Ajustez selon votre logique
    
        // Récupérer les déclarations de naissances filtrées par la commune de l'administrateur
        $naisshops = NaissHop::where('commune', $communeAdmin)->get();
    
        return view('naissHop.mairieindex', [
            'naisshops' => $naisshops,
            'alerts' => $alerts,
            'sousadmin' => $sousadmin
        ]);
    }

    public function agentmairieindex() {
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
            ->latest()
            ->get();
        $sousadmin = Auth::guard('agent')->user();
        
        // Récupérer la commune de l'administrateur
        $communeAdmin = $sousadmin->communeM; // Ajustez selon votre logique
    
        // Récupérer les déclarations de naissances filtrées par la commune de l'administrateur
        $naisshops = NaissHop::where('commune', $communeAdmin)->get();
    
        return view('naissHop.agentmairieindex', [
            'naisshops' => $naisshops,
            'alerts' => $alerts,
            'sousadmin' => $sousadmin
        ]);
    }

    public function mairieDecesindex(){
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();
        $sousadmin = Auth::guard('vendor')->user();
        
        // Récupérer la commune de l'administrateur
        $communeAdmin = $sousadmin->name; // Ajustez selon votre logique
    
        // Récupérer les déclarations de naissances filtrées par la commune de l'administrateur
        $deceshops = DecesHop::where('commune', $communeAdmin)->get();
    
        return view('decesHop.mairieindex', [
            'deceshops' => $deceshops,
            'alerts' => $alerts,
            'sousadmin' => $sousadmin
        ]);
    }

    public function agentmairieDecesindex(){
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();
        $sousadmin = Auth::guard('agent')->user();
        
        // Récupérer la commune de l'administrateur
        $communeAdmin = $sousadmin->communeM; // Ajustez selon votre logique
    
        // Récupérer les déclarations de naissances filtrées par la commune de l'administrateur
        $deceshops = DecesHop::where('commune', $communeAdmin)->get();
    
        return view('decesHop.agentmairieindex', [
            'deceshops' => $deceshops,
            'alerts' => $alerts,
            'sousadmin' => $sousadmin
        ]);
    }
    public function edit(NaissHop $naisshop){
        return view('naissHop.edit', compact('naisshop'));
    }
    public function delete(NaissHop $naisshop){
        try {
            $naisshop->delete();
            return redirect()->route('naissHop.index')->with('success1','La declaration a été supprimé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la suppression du Docteur');
        }
    }

    public function show($id)
    {
        $alerts = Alert::where('is_read', false)
        ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
        ->latest()
        ->get();
        $naisshop = NaissHop::findOrFail($id); // Récupérer les données ou générer une erreur 404 si non trouvé
        return view('naissHop.details', compact('naisshop','alerts'));
    }
    public function mairieshow($id)
    {
        $alerts = Alert::where('is_read', false)
    ->whereIn('type', ['naissance','naissanceD', 'mariage', 'deces','decesHop','naissHop'])  
    ->latest()
    ->get();
        $naisshop = NaissHop::findOrFail($id); // Récupérer les données ou générer une erreur 404 si non trouvé
        return view('naissHop.mairiedetails', compact('naisshop','alerts'));
    }
        

    public function update(UpdateNaissHopRequest $request,NaissHop $naisshop){
        try {
            $naisshop->NomM = $request->NomM;
            $naisshop->PrM = $request->PrM;
            $naisshop->contM = $request->contM;
            $naisshop->CNI_mere = $request->CNI_mere;
            $naisshop->NomP = $request->NomP;
            $naisshop->PrP = $request->PrP;
            $naisshop->contP = $request->contP;
            $naisshop->CNI_Pere = $request->CNI_Pere;
            $naisshop->DateNaissance = $request->DateNaissance;
            $naisshop->sexe = $request->sexe;
            $naisshop->update();

            return redirect()->route('naissHop.index')->with('success','Vos informations ont été mises à jour avec succès.');
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'NomM' => 'required',
        'PrM' => 'required',
        'contM' => 'required|unique:naiss_hops,contM|max:11',
        'dateM' => 'required',
        'CNI_mere' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
        'NomP' => 'required',
        'PrP' => 'required',
        'contP' => 'required|unique:naiss_hops,contP|max:11',
        'NomEnf' => 'required',
        'DateNaissance' => 'required|date',
        'commune' => 'required',
        'sexe' => 'required',
        'codeCMU' => 'required',
        'lien' => 'required',
        'CNI_Pere' => 'required',
    ], [
        'contM.unique' => 'Ce numéro de téléphone est déjà utilisé.',
        'contP.unique' => 'Ce numéro de téléphone est déjà utilisé.',
        'CNI_mere.mimes' => 'Le fichier doit être au format jpeg, png, jpg ou pdf.',
        'CNI_mere.max' => 'Le fichier ne doit pas dépasser 2Mo.',
        'CNI_mere.required' => 'Le champ CNI de la mère est obligatoire.',
        'NomP.required' => 'Le champ nom du père est obligatoire.',
        'PrP.required' => 'Le champ prénom du père est obligatoire.',
        'contP.required' => 'Le champ numéro de téléphone du père est obligatoire.',
        'NomEnf.required' => 'Le champ nom de l\'enfant est obligatoire.',
        'DateNaissance.required' => 'Le champ date de naissance est obligatoire.',
        'commune.required' => 'Le champ commune est obligatoire.',
        'sexe.required' => 'Le champ sexe est obligatoire.',
        'codeCMU.required' => 'Le champ code CMU est obligatoire.',
        'lien.required' => 'Le champ lien est obligatoire.',
        'CNI_Pere.required' => 'Le champ CNI du père est obligatoire.',
    ]);

    // Gérer les fichiers
    $imageBaseLink = '/images/naissances/'; // Base pour les images
    $uploadedPaths = []; // Pour stocker les chemins des fichiers

    // Traitement du fichier CNI de la mère
    if ($request->hasFile('CNI_mere')) {
        $file = $request->file('CNI_mere');
        $extension = $file->getClientOriginalExtension();
        $newFileName = (string) Str::uuid() . '.' . $extension;
        $file->storeAs('public/images/naissances/cni/', $newFileName);
        $uploadedPaths['CNI_mere'] = $imageBaseLink . "cni/" . $newFileName;
    }

    $sousadmin = Auth::guard('sous_admin')->user();
    // Création dans la base de données
    $naissHop = NaissHop::create([
        'NomM' => $validatedData['NomM'],
        'PrM' => $validatedData['PrM'],
        'contM' => $validatedData['contM'],
        'dateM' => $validatedData['dateM'],
        'CNI_mere' => $uploadedPaths['CNI_mere'] ?? null,
        'NomP' => $validatedData['NomP'],
        'PrP' => $validatedData['PrP'],
        'contP' => $validatedData['contP'],
        'NomEnf' => $validatedData['NomEnf'],
        'commune' => $validatedData['commune'],
        'codeCMU' => $validatedData['codeCMU'],
        'lien' => $validatedData['lien'],
        'CNI_Pere' => $validatedData['CNI_Pere'],
        'DateNaissance' => $validatedData['DateNaissance'],
        'sexe' => $validatedData['sexe'],
        'sous_admin_id' => $sousadmin->id, 
    ]);

    // Génération des codes
    $anneeNaissance = date('Y', strtotime($naissHop->DateNaissance));
    $id = $naissHop->id;
    $codeDM = "DM{$anneeNaissance}{$id}225";
    $codeCMN = "CMN{$anneeNaissance}{$id}225";

    $naissHop->update([
        'codeDM' => $codeDM,
        'codeCMN' => $codeCMN,
    ]);


    $sousadmin = Auth::guard('sous_admin')->user();

// Vérifiez si l'utilisateur est authentifié
    if ($sousadmin) {
        $nomSousadmin = $sousadmin->name .' '.$sousadmin->prenom; // Assurez-vous que 'name' est le bon attribut
    } else {
        $nomSousadmin = 'Inconnu'; // Valeur par défaut si l'utilisateur n'est pas authentifié
    }
    $dateCreation = $naissHop->created_at->format('d/m/Y H:i:s');
        // Génération du QR code
    $qrCodeData = "Les Informations concernants la mère \n" .
        "Nom de la mère: {$validatedData['NomM']}\n" .
        "Prénom de la mère: {$validatedData['PrM']}\n" .
        "Contact de la mère: {$validatedData['contM']}\n" .
        "Date de naissance : {$validatedData['dateM']}\n \n" .
        "Les Informations concernants l'enfant \n" .
        "Date de naissance : {$validatedData['DateNaissance']}\n".
        "Sexe : {$validatedData['sexe']}\n".
        "Hôpital de naissance : {$validatedData['NomEnf']}\n".
        "Accompagner par : {$validatedData['NomP']} {$validatedData['PrP']}".
        "Contact de l'accompagnateur: {$validatedData['contP']}".
        "Certificat délivré par le Dr. : {$nomSousadmin}".
        "Date de déclaration : {$dateCreation}";
        

    $qrCode = QrCode::create($qrCodeData)
        ->setSize(300)
        ->setMargin(10);
    
    // Écrire le QR code dans un fichier
    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    
    // Sauvegarder l'image
    $qrCodePath = storage_path("/var/www/e-ci-projet/app/public/naiss_hops/qrcode_{$naissHop->id}.png");
    $result->saveToFile($qrCodePath);
    
    // Récupérer les informations du sous-admin
    $sousadmin = Auth::guard('sous_admin')->user();

    // Générer le PDF
    $pdf = PDF::loadView('naissHop.pdf', compact('naissHop', 'codeDM', 'codeCMN', 'sousadmin', 'qrCodePath'));

    // Sauvegarder le PDF dans le dossier public
    $pdfFileName = "declaration_{$naissHop->id}.pdf";
    $pdf->save(storage_path("app/public/naiss_hops/{$pdfFileName}"));

    Alert::create([
        'type' => 'naissHop',
        'message' => "Une nouvelle déclaration de naissance a été enregistrée par : {$naissHop->nomHop}.",
    ]);

    // Retourner le PDF pour téléchargement direct
    return redirect()->route('naissHop.index')->with('success', 'Déclaration effectuée avec succès');
}

    public function verifierCodeDM(Request $request)
    {
        $codeCMN = $request->input('codeCMN');
        
        // Rechercher dans la table naiss_hops en utilisant le codeCMN
        $naissHop = NaissHop::where('codeCMN', $codeCMN)->first();
    
        if ($naissHop) {
            return response()->json([
                'existe' => true,
                'nomHopital' => $naissHop->NomEnf,
                'nomMere' => $naissHop->NomM . ' ' . $naissHop->PrM,
                'nomPere' => $naissHop->NomP . ' ' . $naissHop->PrP,
                'dateNaiss' => $naissHop->DateNaissance
            ]);
        } else {
            return response()->json(['existe' => false]);
        }
    }


public function download($id)
{
    // Récupérer l'objet NaissHop
    $naissHop = NaissHop::findOrFail($id);

    // Récupérer les informations du sous-admin connecté
    $sousadmin = Auth::guard('sous_admin')->user(); // Supposons que le sous-admin est connecté via `auth`

    if (!$sousadmin) {
        return back()->withErrors(['error' => 'Sous-admin non authentifié.']);
    }

    // Générer le PDF avec les données
    $pdf = PDF::loadView('naissHop.pdf', compact('naissHop', 'sousadmin'));

    // Retourner le PDF pour téléchargement direct
    return $pdf->download("declaration_{$naissHop->id}.pdf");
}




    

}
