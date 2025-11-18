<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['produit_id', 'quantité', 'mouvement'];

    // 🔁 Relation inverse avec Produit
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
