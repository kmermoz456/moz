<?php

namespace App\Models;

use App\Models\Concerns\AppartientAUnAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory, AppartientAUnAdmin;

    protected $table = 'cours';
    protected $fillable = ['titre', 'description', 'niveau', 'matiere', 'fichier_pdf', 'gratuit', 'telechargements', 'cree_par_id'];

    protected $casts = [
        'gratuit' => 'boolean',
    ];
}