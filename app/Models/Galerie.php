<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galerie extends Model
{
    protected $table = 'galerie';
    protected $fillable = ['titre', 'image'];
}
