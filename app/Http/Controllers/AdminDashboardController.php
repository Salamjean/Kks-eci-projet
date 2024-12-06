<?php

namespace App\Http\Controllers;

use App\Models\Deces;
use App\Models\Mariage;
use App\Models\Naissance;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {   
        $totalData = Naissance::count() + Deces::count() + Mariage::count();
        $naissancePercentage = $totalData > 0 ? (Naissance::count() / $totalData) * 100 : 0;
        $decesPercentage = $totalData > 0 ? (Deces::count() / $totalData) * 100 : 0;
        $mariagePercentage = $totalData > 0 ? (Mariage::count() / $totalData) * 100 : 0;
        $naissancedash = Naissance::count();
        $decesdash = Deces::count();
        $mariagedash = Mariage::count();
        $recentNaissances = Naissance::orderBy('created_at', 'desc')->take(3)->get();
        $recentDeces = Deces::orderBy('created_at', 'desc')->take(3)->get();
        $recentMariages = Mariage::orderBy('created_at', 'desc')->take(3)->get();
        return view('admin.dashboard', compact('naissancedash','decesdash','mariagedash','totalData', 'naissancePercentage', 'decesPercentage', 'mariagePercentage','recentNaissances', 'recentDeces', 'recentMariages')); // Créez cette vue
    }

    
}



