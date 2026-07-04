<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'promotion', 'contenu', 'photo', 'publie'];

    protected $casts = [
        'publie' => 'boolean',
    ];
}
