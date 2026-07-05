<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuizQuestionFactory extends Factory
{
    public function definition(): array
    {
        $bonneReponse = fake()->sentence(3);
        $choix = fake()->randomElements([
            $bonneReponse,
            fake()->sentence(3),
            fake()->sentence(3),
            fake()->sentence(3),
        ], 4);
        shuffle($choix);

        return [
            'question' => fake()->sentence(10).' ?',
            'type' => 'unique',
            'choix' => $choix,
            'bonne_reponse' => $bonneReponse,
            'bonnes_reponses' => null,
            'explication' => fake()->optional(0.6)->sentence(15),
        ];
    }

    /**
     * Question à choix multiple (2 ou 3 bonnes réponses parmi les choix).
     */
    public function multiple(): static
    {
        return $this->state(function () {
            $choix = [fake()->sentence(3), fake()->sentence(3), fake()->sentence(3), fake()->sentence(3)];
            $bonnesReponses = fake()->randomElements($choix, fake()->numberBetween(2, 3));

            return [
                'type' => 'multiple',
                'choix' => $choix,
                'bonne_reponse' => '',
                'bonnes_reponses' => $bonnesReponses,
                'explication' => fake()->optional(0.6)->sentence(15),
            ];
        });
    }
}
