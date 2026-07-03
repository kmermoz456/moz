<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    protected $fillable = ['user_id','montant','mois','statut'];
public function user() { return $this->belongsTo(User::class); }
}
