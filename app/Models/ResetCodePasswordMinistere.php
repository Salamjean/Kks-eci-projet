<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePasswordMinistere extends Model
{
    protected $fillable = [
        'code',
        'email',
    ];
}
