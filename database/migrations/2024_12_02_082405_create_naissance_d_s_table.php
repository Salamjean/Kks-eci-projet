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
        Schema::create('naissance_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('number');
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
        Schema::dropIfExists('naissance_d_s');
    }
};
