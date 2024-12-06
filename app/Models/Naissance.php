<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Naissance extends Model
{
    protected $fillable = [
        'nomHopital', 'nomDefunt', 'dateNaiss', 'lieuNaiss', 'identiteDeclarant', 'cdnaiss', 
        'acteMariage', 'commune', 'etat',
    ];
    public function admin()
    {
        return $this->belongsTo(Vendor::class, 'lieuNaiss', 'name');
    }
}
