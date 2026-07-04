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
            'choix' => $choix,
            'bonne_reponse' => $bonneReponse,
        ];
    }
}
