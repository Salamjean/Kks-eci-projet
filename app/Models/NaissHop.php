<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaissHop extends Model
{
    use HasFactory;
    protected $fillable = [
        'NomM',
        'PrM',
        'contM',
        'dateM',
        'CNI_mere',
        'NomP',
        'PrP',
        'contP',
        'CNI_Pere',
        'NomEnf',
        'commune',
        'DateNaissance',
        'codeDM',
        'codeCMN',
        'sexe'
    ];

     // Définir la relation avec le sous-administrateur
     public function sousAdmin()
     {
         return $this->belongsTo(SousAdmin::class, 'sous_admin_id');
     }
}
