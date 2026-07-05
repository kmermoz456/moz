<?php

namespace App\Models;

use App\Models\Concerns\AppartientAUnAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory, AppartientAUnAdmin;

    protected $fillable = ['titre', 'contenu', 'image', 'publie', 'cree_par_id'];

    protected $casts = [
        'publie' => 'boolean',
    ];
}
