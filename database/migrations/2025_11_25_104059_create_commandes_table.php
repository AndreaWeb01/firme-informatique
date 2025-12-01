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
        Schema::create('commandes', function (Blueprint $table) {
           $table->id();

            // Client qui passe la commande
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // Identifiant unique de commande
            $table->string('numero_commande')->unique();

            // Montants
            $table->decimal('montant_total', 12, 2);
            $table->decimal('montant_paye', 12, 2)->default(0);

            // Mode de paiement
            $table->enum('mode_paiement', [
                'mobile_money', 'carte_bancaire', 'paypal', 'espece'
            ])->default('mobile_money');

            // Statut de la commande
            $table->enum('statut', [
                'en_attente',      // commande créée
                'en_preparation',  // picking
                'expediee',        // en route
                'livree',          // reçue
                'annulee'
            ])->default('en_attente');

            // Adresse de livraison (si applicable)
            $table->string('adresse_livraison')->nullable();
            $table->string('ville')->nullable();
            $table->string('telephone')->nullable();

            // Notes supplémentaires
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
