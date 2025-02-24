<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Ajoutez cette ligne
use Illuminate\Notifications\Notifiable;

class SousAdmin extends Authenticatable
{
        use HasFactory, Notifiable;
        protected $fillable = [
            'name',
            'email',
            'password',
            'fonction',
            'sexe',
            'profile_picture',
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
    
        protected $guarded = [];

        public function archive()
        {
            $this->update(['archived_at' => now()]);
        }
    }
    
