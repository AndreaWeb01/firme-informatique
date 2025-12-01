<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
        protected $fillable = [
        'user_id',
        'numero_commande',
        'montant_total',
        'montant_paye',
        'mode_paiement',
        'statut',
        'adresse_livraison',
        'ville',
        'telephone',
        'notes'
    ];

    // Relation avec l'utilisateur (client)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une commande contient plusieurs produits
    public function items()
    {
        return $this->hasMany(CommandeItem::class);
    }
}
