<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;

    protected $table = 'cours';
    protected $fillable = ['titre', 'description', 'niveau', 'matiere', 'fichier_pdf', 'gratuit', 'telechargements'];

    protected $casts = [
        'gratuit' => 'boolean',
    ];
}