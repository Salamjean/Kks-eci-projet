<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'archived_at'
    ];

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

    /**
     * Relation avec les naissances.
     * Un administrateur peut être associé à plusieurs naissances via son "name" (lieu).
     */
    public function naissances()
    {
        return $this->hasMany(Naissance::class, 'lieuNaiss', 'name');
    }

    protected $guarded = [];

    public function archive()
{
    $this->update(['archived_at' => now()]);
}
}
