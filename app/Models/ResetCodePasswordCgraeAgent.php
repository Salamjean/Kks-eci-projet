<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePasswordCgraeAgent extends Model
{
    protected $fillable = [
        'code',
        'email',
    ];
}
