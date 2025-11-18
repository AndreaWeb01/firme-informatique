<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProduits extends Model
{
     protected $fillable = [
        'Nom_TypeProduit',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'ID_TypeProduit');
    }
}
