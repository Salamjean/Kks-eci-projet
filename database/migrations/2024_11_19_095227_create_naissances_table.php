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
        Schema::create('naissances', function (Blueprint $table) {
            $table->id();
            $table->string('nomHopital');
            $table->string('nomDefunt');
            $table->string('dateNaiss');
            $table->string('lieuNaiss');
            $table->string('identiteDeclarant', 255);
            $table->string('cdnaiss',255);
            $table->string('acteMariage',255)->nullable();
            $table->string('commune')->nullable()->after('id');
            $table->string('etat')->default('en cours'); // État par défaut
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naissances');
    }
};
