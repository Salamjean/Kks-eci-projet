<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    protected $fillable = [
        'naiss_hop_id', // Ajoutez 'naiss_hop_id' ici pour autoriser l'assignation de masse
        'date_naissance',
        'nombreEnf',
        'sexe',
    ];
    public function naissHop()
{
    return $this->belongsTo(NaissHop::class);
}
}
