<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $fillable = ['produit_id', 'nom_produit', 'prix', 'quantite'];

    // public function article()
    // {
    //     return $this->hasOne(Produit::class); 
    // }
}
