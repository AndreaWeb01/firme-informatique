<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'Nom_Categorie',
        'slug',
        'ID_TypeProduit',
    ];

    public function typeProduit()
    {
        return $this->belongsTo(TypeProduits::class, 'ID_TypeProduit');
    }

    public function produits()
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }

}
