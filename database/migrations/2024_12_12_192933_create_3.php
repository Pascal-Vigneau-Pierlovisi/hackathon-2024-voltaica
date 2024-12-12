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
        Schema::create('caff', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();

            // Champ pour le manager
            $table->foreignId('manager_id')
                ->nullable()
                ->constrained('caff') // Référence à la même table
                ->nullOnDelete(); // Si le manager est supprimé, mettre `null`

            // Champ pour le grade
            $table->foreignId('grade_id')
                ->constrained('grades') // Référence à la table grades
                ->cascadeOnDelete(); // Supprimer l'association si le grade est supprimé



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caff');
    }
};
