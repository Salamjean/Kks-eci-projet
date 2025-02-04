<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\NaissanceD;
use App\Models\Naissance;
use App\Models\Deces;
use App\Models\Mariage;

class AgenceCgrae extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'contact',
        'password',
        'siege',
        'profile_picture',
        'agence_name',
        'email_verified_at',
        'archived_at'
    ];

    public function naissances()
    {
        return $this->hasMany(NaissanceD::class, 'agent_id');
    }
    public function naissance()
    {
        return $this->hasMany(Naissance::class, 'agent_id');
    }
    public function deces()
    {
        return $this->hasMany(Deces::class, 'agent_id');
    }
    public function mariage()
    {
        return $this->hasMany(Mariage::class, 'agent_id');
    }

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

       /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $guarded = [];

    public function archive()
    {
        $this->update(['archived_at' => now()]);
    }
}

