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
        'archived_at',
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
    public function compteDemandes()
{
    return $this->hasMany(CompteDemande::class);
}

public static function getNextId() // Rendez la méthode publique et statique
{
    // Récupérer le dernier ID et incrémenter
    $lastNaissance = self::orderBy('id', 'desc')->first();
    if ($lastNaissance) {
        return $lastNaissance->id + 1;
    } else {
        return 1; // Si c'est le premier enregistrement
    }
}

public function motifAnnulation()
{
    return $this->belongsTo(Motif::class, 'motif_id'); // Make sure 'motif_id' is correct
}

public function archive()
{
    $this->update(['archived_at' => now()]);
}

}
