<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('naiss_hops', function (Blueprint $table) {
            $table->id();
            // les informations de la mere
            $table->string('NomM');
            $table->string('PrM');
            $table->string('contM');
            $table->string('CNI_mere')->nullable();
            // les informations du pere
            $table->string('NomP');
            $table->string('PrP');
            $table->string('contP');
            $table->string('CNI_Pere')->nullable();
            // les informations de l'enfant
            $table->string('NomEnf');
            $table->string('DateNaissance');
            $table->string('sexe');
            $table->string('codeDM')->default('rien')->unique();
            $table->string('codeCMN')->default('rien')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naiss_hops');
    }
};
