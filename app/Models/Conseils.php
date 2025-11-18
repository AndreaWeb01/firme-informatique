<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conseils extends Model
{
    protected $fillable = [
        'titre',
        'image',
        'description'
    ];
}

