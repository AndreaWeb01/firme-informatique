<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentlyViewed extends Model
{
    use HasFactory;

    protected $table = 'recently_viewed'; // ← LE BON NOM DE TABLE

    protected $fillable = [
        'user_id',
        'produit_id'
    ];

    public $timestamps = true;

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
