<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveNaissanceDRequest;
use App\Models\Alert;
use App\Models\NaissanceD;
use Exception;
use Illuminate\Http\Request;

class NaissanceDeclaController extends Controller
{
    public function create(){
        return view('naissanceD.create');
    }
    public function index(){
        return view('naissanceD.index');
    }

    public function store(saveNaissanceDRequest $request){
        try {

            $naissanceD = new NaissanceD();
            $naissanceD -> name = $request->name;
            $naissanceD -> Number = $request->number;

            $naissanceD->save();
            Alert::create([
                'type' => 'naissance',
                'message' => "Une nouvelle demande d'extrait a été enregistrée : {$naissanceD->name}.",
            ]);
            return redirect()->route('dashboard')->with('success', 'Votre demande a été traitée avec succès.');
        } catch (Exception $e) {
            dd($e);
        }
    }


}
