<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecesHop extends Model
{
    use HasFactory;
    protected $fillable = [
        'NomM',
        'PrM',
        'DateNaissance',
        'DateDeces',
        'Remarques',
        'nomHop',
        'choix',
        'commune',
        'codeDM',
        'codeCMD',
        'sous_admin_id',  // Ajout de sous_admin_id
    ];

     // Définir la relation avec le docteur
        public function sous_admin()
        {
            return $this->belongsTo(SousAdmin::class);
        }
}
