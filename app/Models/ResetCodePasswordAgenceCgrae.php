<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePasswordAgenceCgrae extends Model
{
    protected $fillable = ['code', 'email'];
}
