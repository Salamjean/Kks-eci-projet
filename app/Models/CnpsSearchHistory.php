<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CnpsSearchHistory extends Model
{
    use HasFactory;

    protected $table = 'cnps_search_history'; // Correspond au nom de votre table
    protected $fillable = [
        'agent_name',
        'agent_prenom',
        'defunt_nom',
        'defunt_prenom',
        'codeCMD',
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