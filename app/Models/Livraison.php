<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Livraison extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'contact',
        'password',
        'profile_picture',
        'commune',
        'communeM',
        'archived_at'
    ];

    public function naissances()
    {
        return $this->hasMany(NaissanceD::class, 'livraison_id');
    }
    public function naissance()
    {
        return $this->hasMany(Naissance::class, 'livraison_id');
    }
    public function deces()
    {
        return $this->hasMany(Deces::class, 'livraison_id');
    }
    public function mariage()
    {
        return $this->hasMany(Mariage::class, 'livraison_id');
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

