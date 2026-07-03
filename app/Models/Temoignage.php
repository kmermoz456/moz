<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    protected $fillable = ['nom', 'promotion', 'contenu', 'photo', 'publie'];

    protected $casts = [
        'publie' => 'boolean',
    ];
}
