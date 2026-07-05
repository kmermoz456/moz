<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPhysique extends Model
{
    use HasFactory;

    protected $table = 'documents_physiques';

    protected $fillable = ['titre', 'description', 'categorie', 'niveau', 'prix', 'image', 'disponible'];

    protected $casts = [
        'disponible' => 'boolean',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'document_id');
    }
}
