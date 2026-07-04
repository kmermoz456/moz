<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    private const MATIERES = [
        'L1' => ['Biologie cellulaire', 'Chimie générale', 'Géologie générale', 'Mathématiques', 'Physique'],
        'L2' => ['Biochimie structurale', 'Physiologie animale', 'Écologie', 'Chimie organique', 'Génétique'],
    ];

    public function definition(): array
    {
        $niveau = fake()->randomElement(['L1', 'L2']);
        $matiere = fake()->randomElement(self::MATIERES[$niveau]);

        return [
            'titre' => 'Quiz — '.$matiere,
            'niveau' => $niveau,
            'matiere' => $matiere,
        ];
    }
}
