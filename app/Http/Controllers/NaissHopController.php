<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateNaissHopRequest;
use App\Models\Alert;
use App\Models\Doctor;
use App\Models\NaissHop;
use App\Models\SousAdmin;
use PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NaissHopController extends Controller
{
    public function create(){
        $doctor = Doctor::all();
        return view('naissHop.create', compact('doctor'));
    }
    public function index(){
        $naisshops = NaissHop::all(); // Récupère toutes les déclarations
        return view('naissHop.index', ['naisshops' => $naisshops]);
    }
    public function edit(NaissHop $naisshop){
        return view('naissHop.edit', compact('naisshop'));
    }
    public function delete(NaissHop $naisshop){
        try {
            $naisshop->delete();
            return redirect()->route('naissHop.index')->with('success1','Le Docteur a été supprimé avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la suppression du Docteur');
        }
    }

    public function show($id)
    {
        $naisshop = NaissHop::findOrFail($id); // Récupérer les données ou générer une erreur 404 si non trouvé
        return view('naissHop.details', compact('naisshop'));
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
            $naisshop->NomEnf = $request->NomEnf;
            $naisshop->DateNaissance = $request->DateNaissance;
            $naisshop->update();

            return redirect()->route('naissHop.index')->with('success','Vos informations ont été mises à jour avec succès.');
        } catch (Exception $e) {
            // dd($e);
            throw new Exception('error','Une erreur est survenue lors de la modification de la declaration');
        }
    }

    public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'NomM' => 'required',
        'PrM' => 'required',
        'contM' => 'required|unique:naiss_hops,contM|max:11',
        'CNI_mere' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
        'NomP' => 'required',
        'PrP' => 'required',
        'contP' => 'required|unique:naiss_hops,contP|max:11',
        'CNI_Pere' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        'NomEnf' => 'required',
        'DateNaissance' => 'required|date',
        'sexe'=>'required',
    ], [
        'NomM.required' => 'Le nom de la mère est obligatoire',
        'PrM.required' => 'Le prénom de la mère est obligatoire',
        'contM.required' => 'Le contact est obligatoire',
        'contM.max' => 'Le contact doit être 10 chiffres',
        'CNI_mere.mimes' => 'Le format du fichier de la CNI doit être jpeg, png, jpg ou pdf',
        'CNI_mere.max' => 'Le fichier de la CNI ne peut dépasser 2Mo',
        'NomP.required' => 'Le nom de l\'accompagnateur est obligatoire',
        'PrP.required' => 'Le prénom de l\'accompagnateur est obligatoire',
        'contP.required' => 'Le contact est obligatoire',
        'contP.max' => 'Le contact doit être 10 chiffres',
        'CNI_Pere.mimes' => 'Le format du fichier de la CNI doit être jpeg, png, jpg ou pdf',
        'CNI_Pere.max' => 'Le fichier de la CNI ne peut dépasser 2Mo',
        'NomEnf.required' => 'Le nom de l\'enfant est obligatoire',
        'DateNaissance.required' => 'La date de naissance est obligatoire',
        'sexe.required' => 'Le sexe est obligatoire',
    ]);

    // Gérer les fichiers
    $uploadedFiles = [];
    if ($request->hasFile('CNI_mere')) {
        $uploadedFiles['CNI_mere'] = $request->file('CNI_mere')->store('public/naiss_hops');
    }
    if ($request->hasFile('CNI_Pere')) {
        $uploadedFiles['CNI_Pere'] = $request->file('CNI_Pere')->store('public/naiss_hops');
    }

    // Création dans la base de données
    $naissHop = NaissHop::create([
        'NomM' => $validatedData['NomM'],
        'PrM' => $validatedData['PrM'],
        'contM' => $validatedData['contM'],
        'CNI_mere' => $uploadedFiles['CNI_mere'] ?? null,
        'NomP' => $validatedData['NomP'],
        'PrP' => $validatedData['PrP'],
        'contP' => $validatedData['contP'],
        'CNI_Pere' => $uploadedFiles['CNI_Pere'] ?? null,
        'NomEnf' => $validatedData['NomEnf'],
        'DateNaissance' => $validatedData['DateNaissance'],
        'sexe' => $validatedData['sexe'],
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

    // Récupérer les informations du sous-admin (modifiez selon votre logique)
    $sousadmin = SousAdmin::all(); // 
   
    // Générer le PDF
    $pdf = PDF::loadView('naissHop.pdf', compact('naissHop', 'codeDM', 'codeCMN', 'sousadminNom'));

    // Sauvegarder le PDF dans le dossier public
    $pdfFileName = "declaration_{$naissHop->id}.pdf";
    $pdf->save(storage_path("app/public/naiss_hops/{$pdfFileName}"));

    // Retourner le PDF pour téléchargement direct
    return redirect()->route('naissHop.index')->with('success', 'Déclaration effectuée avec succès');
}

    
    
    // NaissHopController.php
// NaissHopController.php

public function verifierCodeDM(Request $request)
{
    $codeCMN = $request->input('codeCMN');
    
    // Rechercher dans la table naiss_hops en utilisant le codeDM
    $naissHop = NaissHop::where('codeCMN', $codeCMN)->first();

    if ($naissHop) {
        return response()->json([
            'existe' => true,
            'nomHopital' => 'HOSPITAL GEMMA',  // Vous pouvez aussi le récupérer dynamiquement si nécessaire
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

    // Récupérer le nom et le prénom du sous-admin connecté

    $sousadminNom = Auth::guard('sous_admin')->user()->name . ' ' .Auth::guard('sous_admin')->user()->prenom ?? 'Nom introuvable'; // Assurez-vous que le champ `name` contient le nom complet
    $NomHop = Auth::guard('doctor')->user()->nomHop ?? 'Nom introuvable'; // Assurez-vous que le champ `name` contient le nom complet

    // Générer le PDF
    $pdf = PDF::loadView('naissHop.pdf', compact('naissHop', 'sousadminNom','NomHop'));

    // Retourner le PDF pour téléchargement direct
    return $pdf->download("declaration_{$naissHop->id}.pdf");
}




    

}
