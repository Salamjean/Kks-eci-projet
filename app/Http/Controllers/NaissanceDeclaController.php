<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveNaissanceDRequest;
use App\Models\Alert;
use App\Models\NaissanceD;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NaissanceDeclaController extends Controller
{
    public function create(){
        return view('naissanceD.create');
    }
    public function index(){
        return view('naissanceD.index');
    }

    public function store(saveNaissanceDRequest $request)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
    
        // Enregistrement de l'objet NaissanceDecl
        $naissanceD = new NaissanceD();
        $naissanceD->type = $request->type;
        $naissanceD->name = $request->name;
        $naissanceD->number = $request->number;
        $naissanceD->commune = $user->commune;
        $naissanceD->etat = 'en attente';
        $naissanceD->user_id = $user->id;
    
        $naissanceD->save();
    
        Alert::create([
            'type' => 'naissanceDecl',
            'message' => "Une nouvelle déclaration de naissance a été enregistrée : {$naissanceD->name}.",
        ]);
    
        return redirect()->back()->with('success', 'Votre déclaration de naissance a été enregistrée avec succès.');
    }
    


}
