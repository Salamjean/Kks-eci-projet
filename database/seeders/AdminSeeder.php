<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Locataire;
use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       SuperAdmin::create([
            'name' => 'KKS-technologies',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('azertyui'),
        ]);
    }
}
