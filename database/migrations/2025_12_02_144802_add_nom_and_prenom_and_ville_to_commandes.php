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
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('nom')->nullable();      // Ajouter la colonne 'nom'
            $table->string('prenom')->nullable();   // Ajouter la colonne 'prenom'
   // Ajouter la colonne 'ville
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('nom');              // Supprimer la colonne 'nom'
            $table->dropColumn('prenom');           // Supprimer la colonne 'prenom'
 
        });
    }
};
