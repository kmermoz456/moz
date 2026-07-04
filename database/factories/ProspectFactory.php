<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProspectFactory extends Factory
{
    private const PRENOMS = ['Aya', 'Kouassi', 'Adjoua', 'Yao', 'Awa', 'Koffi', 'Mariam', 'Ismael', 'Affoué', 'Serge'];
    private const NOMS = ['Kouadio', 'Traoré', 'Koné', 'Ouattara', 'Bamba', 'Diabaté', 'Coulibaly', 'Kra', 'Assi'];

    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement(self::PRENOMS).' '.fake()->randomElement(self::NOMS),
            'telephone' => sprintf('0%d%08d', fake()->randomElement([1, 5, 7]), fake()->numberBetween(0, 99999999)),
            'page_source' => fake()->randomElement(['accueil', 'whatsapp', 'statistiques', 'pourquoi', 'universite', 'apropos']),
        ];
    }
}
