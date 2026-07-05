<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'question', 'type', 'choix', 'bonne_reponse', 'bonnes_reponses'];

    protected $casts = [
        'choix' => 'array',
        'bonnes_reponses' => 'array',
    ];

    public function estAChoixMultiple(): bool
    {
        return $this->type === 'multiple';
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
