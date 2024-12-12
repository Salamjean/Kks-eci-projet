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
        Schema::create('mariages', function (Blueprint $table) {
            $table->id();
            $table->string('nomEpoux')->nullable();
            $table->string('prenomEpoux')->nullable();
            $table->string('dateNaissanceEpoux')->nullable();
            $table->string('lieuNaissanceEpoux')->nullable();
            $table->string('pieceIdentite');
            $table->string('extraitMariage');
            $table->string('commune')->nullable()->after('id');
            $table->string('etat')->default('en attente'); // État par défaut
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ajout de user_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mariages');
    }
};
