<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalerieFactory extends Factory
{
    private const TITRES = [
        'Séance de renforcement en biologie',
        'Groupe d\'étudiants Licence 1',
        'Session de révision avant les partiels',
        'Remise des attestations de fin de mois',
        'Atelier exercices corrigés',
        'Rencontre avec la promotion Licence 2',
        'Journée d\'accueil des nouveaux bacheliers',
        'Cours de renforcement en chimie',
        'Groupe de travail en petit effectif',
        'Moment convivial entre étudiants ITF',
    ];

    public function definition(): array
    {
        return [
            'titre' => fake()->unique()->randomElement(self::TITRES),
            'image' => null,
        ];
    }
}
