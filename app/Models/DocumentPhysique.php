<?php

namespace App\Models;

use App\Models\Concerns\AppartientAUnAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPhysique extends Model
{
    use HasFactory, AppartientAUnAdmin;

    protected $table = 'documents_physiques';

    protected $fillable = ['titre', 'description', 'categorie', 'niveau', 'prix', 'image', 'disponible', 'cree_par_id'];

    protected $casts = [
        'disponible' => 'boolean',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'document_id');
    }
}
