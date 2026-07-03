<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    protected $fillable = ['titre', 'contenu', 'image', 'publie'];

    protected $casts = [
        'publie' => 'boolean',
    ];
}
