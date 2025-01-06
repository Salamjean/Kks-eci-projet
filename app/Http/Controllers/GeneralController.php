<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function general(){
        return view('pages.espace');
    }

    public function naissanceavec(){
        return view('pages.naissanceavec');
    }

    public function naissancesans(){
        return view('pages.naissancesans');
    }

    public function decesavec(){
        return view('pages.decesavec');
    }

    public function decessans(){
        return view('pages.decessans');
    }

    public function mariagesans(){
        return view('pages.mariage');
    }

    

    
    
}
