<?php

namespace App\Models\Concerns;

use App\Models\User;

/**
 * Rattache un contenu (cours, quiz, témoignage, actualité, photo, document...)
 * à l'administrateur qui l'a créé, afin qu'un admin normal ne voie et ne
 * modifie que ses propres créations. Un super admin voit tout.
 */
trait AppartientAUnAdmin
{
    public static function bootAppartientAUnAdmin(): void
    {
        static::creating(function ($model) {
            if (empty($model->cree_par_id) && auth()->check()) {
                $model->cree_par_id = auth()->id();
            }
        });
    }

    public function creePar()
    {
        return $this->belongsTo(User::class, 'cree_par_id');
    }

    public function scopeVisiblesPar($query, User $user)
    {
        return $user->estSuperAdmin() ? $query : $query->where('cree_par_id', $user->id);
    }

    public function estModifiablePar(User $user): bool
    {
        return $user->estSuperAdmin() || $this->cree_par_id === $user->id;
    }
}
