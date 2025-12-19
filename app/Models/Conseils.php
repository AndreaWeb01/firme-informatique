<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conseils extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'image', 'description'];
}

