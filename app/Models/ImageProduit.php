<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageProduit extends Model
{
    protected $table = 'images_produits';
    
    protected $fillable = ['produit_id', 'chemin_image'];
    

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
