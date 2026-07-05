<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    private const MATIERES = [
        'L1' => ['Biologie cellulaire', 'Chimie générale', 'Géologie générale', 'Mathématiques', 'Physique'],
        'L2' => ['Biochimie structurale', 'Physiologie animale', 'Écologie', 'Chimie organique', 'Génétique'],
    ];

    public function run(): void
    {
        $superAdmin = User::where('email', 'admin@itf.ci')->value('id');
        $autreAdmin = User::where('email', 'marie.kouassi@itf.ci')->value('id');

        foreach (self::MATIERES as $niveau => $matieres) {
            foreach ($matieres as $matiere) {
                $quiz = Quiz::factory()->create([
                    'titre' => 'Quiz — '.$matiere,
                    'niveau' => $niveau,
                    'matiere' => $matiere,
                    'cree_par_id' => $niveau === 'L1' ? $superAdmin : $autreAdmin,
                ]);

                $quiz->questions()->saveMany([
                    ...\App\Models\QuizQuestion::factory()->count(4)->make(),
                    \App\Models\QuizQuestion::factory()->multiple()->make(),
                ]);
            }
        }

        // Historique de quelques tentatives pour les étudiants existants
        $etudiants = User::where('role', 'etudiant')->get();

        foreach ($etudiants->random(min(10, $etudiants->count())) as $etudiant) {
            $quiz = Quiz::where('niveau', $etudiant->niveau)->inRandomOrder()->first();

            if (! $quiz) {
                continue;
            }

            $total = $quiz->questions()->count();

            QuizAttempt::create([
                'user_id' => $etudiant->id,
                'quiz_id' => $quiz->id,
                'score' => fake()->numberBetween(0, $total),
                'total' => $total,
            ]);
        }
    }
}
