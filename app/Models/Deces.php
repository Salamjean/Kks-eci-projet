<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deces extends Model
{
    protected $fillable = [
        'nomHopital',
        'dateDces',
        'nomDefunt',
        'dateNaiss',
        'lieuNaiss',
        'identiteDeclarant',
        'acteMariage',
        'deParLaLoi',
        'commune',
        'etat',
        'user_id',  // Ajout de user_id
    ];

    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class); // Associe à la table users
    }
}
