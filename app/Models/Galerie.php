<?php

namespace App\Models;

use App\Models\Concerns\AppartientAUnAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    use HasFactory, AppartientAUnAdmin;

    protected $table = 'galerie';
    protected $fillable = ['titre', 'image', 'cree_par_id'];
}
