<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePasswordAgenceCnps extends Model
{
    protected $fillable = ['code', 'email'];
}
