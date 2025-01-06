<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetCodePasswordAjoint extends Model
{
    protected $fillable = ['code', 'email'];
}
