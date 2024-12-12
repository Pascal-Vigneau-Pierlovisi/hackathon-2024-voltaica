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
        Schema::create('facture_completude', function (Blueprint $table) {
            $table->id(); // Identifiant unique de la facture

            // Relation avec le dossier
            $table->unsignedBigInteger('id_dossier');
            $table->foreign('id_dossier')->references('id')->on('dossier')->onDelete('cascade');

            // Colonnes spécifiques
            $table->decimal('remuneration', 10, 2); // Montant de la rémunération
            $table->date('date_estimee'); // Date estimée de la rémunération

            // Puissance estimée récupérée du dossier
            $table->integer('puissance_estimee'); // Puissance en kWc (sera liée au dossier)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facture_completude');
    }
};
