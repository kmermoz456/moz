<?php

namespace App\Models;

use App\Models\Concerns\AppartientAUnAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    use HasFactory, AppartientAUnAdmin;

    protected $fillable = ['nom', 'promotion', 'contenu', 'photo', 'publie', 'cree_par_id'];

    protected $casts = [
        'publie' => 'boolean',
    ];
}
