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
        Schema::create('dossier', function (Blueprint $table) {
            $table->id();

            // Relation avec la table clients
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');

            // Relation avec la table caff
            $table->unsignedBigInteger('id_caff');
            $table->foreign('id_caff')->references('id')->on('caff')->onDelete('cascade');

            // Colonnes supplémentaires
            $table->string('localisation');
            $table->double('superficie');
            $table->double('irradiance'); // Quantité d'énergie solaire reçue par unité de surface (kWh/m²)
            $table->string('points_gps');
            $table->double('raccordement'); // Distance pour le raccordement
            $table->enum('type', ['Rénovation', 'Construction']);
            $table->string('type_construction')->nullable();
            $table->boolean('apporteur_affaire');
            $table->integer('puissance_estimee'); // Puissance estimée en kWc
            $table->enum('status', ['En cours', 'Abandonné', 'Etabli']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier');
    }
};
