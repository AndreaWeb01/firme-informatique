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
             $table->string('adresse_de_livraison')->nullable();
            $table->string('numero')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
             $table->dropColumn('adresse_de_livraison'); // Suppression de la colonne adresse_de_livraison
            $table->dropColumn('numero'); // Suppression de la colonne numero

        });
    }
};
