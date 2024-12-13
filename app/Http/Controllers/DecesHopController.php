<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DecesHopController extends Controller
{
    public function index(){
        return view('decesHop.index');
    }
    public function create(){
        return view('decesHop.create');
    }
}
