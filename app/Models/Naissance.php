<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Naissance extends Model
{
    protected $fillable = [
        'nomHopital', 'nomDefunt', 'dateNaiss', 'lieuNaiss', 'identiteDeclarant', 'cdnaiss', 
        'acteMariage', 'commune', 'etat',
    ];
    protected $attributes = [
        'etat' => 'En attente', // Valeur par défaut si nécessaire
    ];
    public function admin()
    {
        return $this->belongsTo(Vendor::class, 'lieuNaiss', 'name');
    }
}
