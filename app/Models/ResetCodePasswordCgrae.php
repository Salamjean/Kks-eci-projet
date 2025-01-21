<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePasswordCgrae extends Model
{
    protected $fillable = [
        'code',
        'email',
    ];
}
