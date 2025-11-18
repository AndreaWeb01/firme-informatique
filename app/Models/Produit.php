<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'image_principale',
        'statut',
        'categorie_id',
        'prix'
    ];

    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    public function images()
    {
        return $this->hasMany(ImageProduit::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stockDisponible()
    {
        return $this->stocks()->sum('quantite');
    }

}
