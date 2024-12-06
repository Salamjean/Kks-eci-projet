<?php

namespace App\Policies;

use App\Models\Naissance;
use App\Models\User;
use App\Models\Vendor;

class NaissancePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(Vendor $admin, Naissance $naissance)
{
    // Autorise uniquement si le lieuNaiss correspond au name de l'admin
    return $naissance->lieuNaiss === $admin->name;
}
}
