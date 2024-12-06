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
        Schema::create('deces', function (Blueprint $table) {
            $table->id();
            $table->string('nomHopital');
            $table->string('dateDces');
            $table->string('nomDefunt');
            $table->string('dateNaiss');
            $table->string('lieuNaiss');
            $table->string('identiteDeclarant');
            $table->string('acteMariage')->nullable();
            $table->string('deParLaLoi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deces');
    }
};
