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
    { Schema::table('commandes', function (Blueprint $table) {
        // On supprime d'abord la contrainte
        $table->dropForeign(['user_id']);

        // Puis on rend la colonne nullable
        $table->foreignId('user_id')->nullable()->change();

        // Et on remet une contrainte, mais sans "not null"
        $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->change();
        });
    }
};
