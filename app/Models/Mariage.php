<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mariage extends Model
{
    protected $fillable = [
        'nomEpoux',
        'prenomEpoux',
        'dateNaissanceEpoux',
        'lieuNaissanceEpoux',
        'pieceIdentite',
        'extraitMariage',
        'commune',
        'etat',
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

    public function livraison()
    {
        return $this->belongsTo(Livraison::class, 'livraison_id');
    }

    public static function getNextId()
    {
        $lastMariage = self::orderBy('id', 'desc')->first();
        if ($lastMariage) {
            return $lastMariage->id + 1;
        } else {
            return 1;
        }
    }
    public function scopeTerminated($query) {
        return $query->where('etat', 'terminé');
    }
}


