<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorDashboard extends Controller
{
    public function index(){
        return view('doctor.dashboard');
    }

    public function logout(){
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }

    
}
