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
        Schema::table('dossier', function (Blueprint $table) {
            // Suppression des colonnes
            $table->dropColumn([
                'localisation',
                'superficie',
                'irradiance',
                'points_gps',
                'raccordement',
                'type',
                'type_construction',
            ]);

            // Ajout des nouvelles colonnes
            $table->date('date_completude')->nullable();
            $table->date('date_signature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dossier', function (Blueprint $table) {
            // Ajout des colonnes supprimées
            $table->string('localisation', 255)->nullable();
            $table->double('superficie')->nullable();
            $table->double('irradiance')->nullable();
            $table->string('points_gps', 255)->nullable();
            $table->double('raccordement')->nullable();
            $table->enum('type', ['option1', 'option2'])->nullable(); // Remplacez 'option1', 'option2' par les valeurs appropriées
            $table->string('type_construction', 255)->nullable();

            // Suppression des colonnes ajoutées
            $table->dropColumn(['date_completude', 'date_signature']);
        });
    }
};
