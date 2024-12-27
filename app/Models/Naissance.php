<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Naissance extends Model
{
    protected $fillable = [
        'nomHopital',
        'nomDefunt',
        'dateNaiss',
        'lieuNaiss',
        'identiteDeclarant',
        'cdnaiss',
        'acteMariage',
        'commune',
        'nom',
        'prenom',
        'nompere',
        'prenompere',
        'datepere',
        'etat',
        'user_id',  // Ajout de user_id
        'agent_id',  // Ajout de agent_id
    ];

    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class); // Associe à la table users
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
