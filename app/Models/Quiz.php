<?php

namespace App\Models;

use App\Models\Concerns\AppartientAUnAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory, AppartientAUnAdmin;

    protected $table = 'quiz';
    protected $fillable = ['titre', 'niveau', 'matiere', 'cree_par_id'];

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
