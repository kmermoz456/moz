<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentPhysiqueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(4),
            'description' => fake()->sentence(15),
            'categorie' => fake()->randomElement(["Recueil d'anciens sujets", 'Fiche de révision', 'Livret de TD']),
            'niveau' => fake()->randomElement(['L1', 'L2', 'Tous']),
            'prix' => fake()->randomElement([1000, 1500, 2000, 2500, 3000]),
            'image' => null,
            'disponible' => true,
        ];
    }
}
