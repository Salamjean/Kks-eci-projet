<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePasswordCnps extends Model
{
    protected $fillable = [
        'code',
        'email',
    ];
}
