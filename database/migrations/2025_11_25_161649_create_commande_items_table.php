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
        Schema::create('commande_items', function (Blueprint $table) {
            $table->id();

            // Relation vers commande
            $table->foreignId('commande_id')
                  ->constrained('commandes')
                  ->onDelete('cascade');

            // Relation vers produit
            $table->foreignId('produit_id')
                  ->constrained('produits')
                  ->onDelete('cascade');

            // Quantité + prix du produit lors de la commande
            $table->integer('quantite')->default(1);
            $table->decimal('prix_unitaire', 12, 2);
            $table->decimal('total', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commande_items');
    }
};
