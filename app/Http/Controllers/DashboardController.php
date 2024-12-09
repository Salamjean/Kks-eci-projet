<?php

namespace App\Http\Controllers;

use App\Models\Naissance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $naissances = Naissance::all();
        return view('dashboard', compact('naissances'));
    }
}
