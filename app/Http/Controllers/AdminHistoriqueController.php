<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\Deces;
use App\Models\Decesdeja;
use App\Models\Mariage;
use App\Models\Naissance;
use App\Models\NaissanceD;
use App\Models\NaissHop;
use Illuminate\Http\Request;

class AdminHistoriqueController extends Controller
{
    public function taskend() {
        // Récupération des alertes non lues
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
            ->latest()
            ->get();
    
        // Récupération des mariages terminés
        $taskendnaissanceDs = NaissanceD::where('etat', 'terminé')
            ->latest()
            ->paginate(10);
    
        // Récupération des naissances terminées
        $taskendnaissances = Naissance::where('etat', 'terminé')
            ->latest()
            ->paginate(10);
        $naisshop = NaissHop::first();
    
        return view('vendor.history.taskends', compact(
            'alerts',
            'taskendnaissanceDs',
            'taskendnaissances',
            'naisshop'
        ));
    }

    public function taskenddeces(){
        // Récupération des alertes non lues
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
            ->latest()
            ->get();
         // Récupération des mariages terminés
         $taskenddeces = Deces::where('etat', 'terminé')
         ->latest()
         ->paginate(10);
 
        // Récupération des naissances terminées
        $taskenddecedejas = Decesdeja::where('etat', 'terminé')
         ->latest()
         ->paginate(10);
        return view('vendor.history.taskenddeces',compact(
            'alerts',
            'taskenddeces',
            'taskenddecedejas'
        ));
    }

    public function taskendmariages(){
        // Récupération des alertes non lues
        $alerts = Alert::where('is_read', false)
            ->whereIn('type', ['naissance', 'mariage', 'deces','decesHop','naissHop'])  
            ->latest()
            ->get();
         // Récupération des mariages terminés
         $taskendmariages = Mariage::where('etat', 'terminé')
            ->latest()
            ->paginate(10);

        return view('vendor.history.taskendmariages',compact(
            'alerts',
            'taskendmariages',
        ));
    }
}
