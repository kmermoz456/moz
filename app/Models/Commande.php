<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'document_id', 'quantite', 'prix_unitaire', 'statut', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->belongsTo(DocumentPhysique::class, 'document_id');
    }

    public function total(): int
    {
        return $this->quantite * $this->prix_unitaire;
    }
}
