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
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Colonne id
            $table->string('nom'); // Colonne nom
            $table->string('prenom'); // Colonne prénom
            $table->date('date_naissance'); // Colonne date de naissance
            $table->string('adresse'); // Colonne adresse
            $table->string('siret')->unique(); // Colonne SIRET unique
            $table->string('email')->unique(); // Colonne email unique
            $table->string('telephone')->nullable(); // Colonne téléphone (nullable)
            $table->string('nom_entreprise'); // Colonne nom de l'entreprise
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cients');
    }
};
