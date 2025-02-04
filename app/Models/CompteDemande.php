<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompteDemande extends Model
{
    protected $fillable = [
        'montant_timbre',
        'montant_livraison',
        'name',
        'prenom',
        'email',
        'contact',
        'adresse_livraison',
        'code_postal',
        'ville',
        'commune',
    ];
public function naissance()
{
    return $this->belongsTo(Naissance::class);
}
}
