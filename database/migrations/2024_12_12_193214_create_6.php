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
        Schema::table('caff', function (Blueprint $table) {
            $table->string('username')->unique()->after('prenom'); // Ajouter un username unique
            $table->string('password')->after('username'); // Ajouter un password
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('caff', function (Blueprint $table) {
            $table->dropColumn(['username', 'password']); // Supprimer les colonnes ajoutées
        });
    }
};
