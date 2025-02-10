<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinistereSearchHistory extends Model
{
    use HasFactory;

    protected $table = 'ministere_search_history'; // Correspond au nom de votre table
    protected $fillable = [
        'agent_name',
        'agent_prenom',
        'recherche_type',
        'defunt_nom',
        'defunt_prenom',
        'naissance_nom',
        'naissance_prenom',
        'codeCMD',
        'codeCMN',
        'search_term',
        'cnpsagent_id',
        'created_at',
        'updated_at'
    ];

    // Relation avec le modèle CnpsAgent (si vous avez un modèle CnpsAgent)
    public function cnpsagent()
    {
        return $this->belongsTo(CnpsAgent::class);
    }
}