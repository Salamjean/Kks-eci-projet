<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Naissance;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
        public function dashboard()
        {
            // Récupérer les données depuis la base de données
            return view('admin.dashboard');
        }
    }

