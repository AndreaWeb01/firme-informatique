<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'token',
        'amount',
        'status',
        'commande_id',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
