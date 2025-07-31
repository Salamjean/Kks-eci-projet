<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CompteDemande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompteDemandeController extends Controller
{
    public function create(){
        Log::info('Create method called');
        return view('compte_demande.create');
    }
    public function store(Request $request)
{
    Log::info('Store method called', $request->all());
    $request->validate([
        'montant_timbre' => 'required|string',
        'montant_livraison' => 'required|string',
        'name' => 'required|string',
        'prenom' => 'required|string',
        'contact' => 'required|string',
        'email' => 'required|string',
        'adresse_livraison' => 'required|string',
        'ville' => 'required|string',
        'commune' => 'required|string',
    ],[
        'montant_timbre.required' => 'Le montant du timbre est obligatoire',
       'montant_livraison.required' => 'Le montant de la livraison est obligatoire',
         'name.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prenom est obligatoire',
            'contact.required' => 'Le contact est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'adresse_livraison.required' => 'L\'adresse de livraison est obligatoire',
            'ville.required' => 'La ville est obligatoire',
            'commune.required' => 'La ville est obligatoire',
    ]);

    CompteDemande::create($request->all());

    return response()->json(['success' => true]);
}

public function initPaiement($id){
    dd($id);
}



}
