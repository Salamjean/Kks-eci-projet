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
        'commune',
        'codeDM',
        'codeCMD',
    ];
}
