<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'question', 'type', 'choix', 'bonne_reponse', 'bonnes_reponses', 'explication'];

    protected $casts = [
        'choix' => 'array',
        'bonnes_reponses' => 'array',
    ];

    public function estAChoixMultiple(): bool
    {
        return $this->type === 'multiple';
    }

    /**
     * Vérifie si la réponse d'un étudiant est correcte (choix unique : chaîne, choix multiple : tableau).
     */
    public function estCorrecte(mixed $reponseEtudiant): bool
    {
        if ($this->estAChoixMultiple()) {
            $donnee = array_values((array) $reponseEtudiant);
            $attendu = array_values($this->bonnes_reponses ?? []);
            sort($donnee);
            sort($attendu);

            return $donnee === $attendu;
        }

        return $reponseEtudiant === $this->bonne_reponse;
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
