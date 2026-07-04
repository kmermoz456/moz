<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaiementFactory extends Factory
{
    public function definition(): array
    {
        $date = fake()->dateTimeBetween('-4 months', 'now');

        return [
            'user_id' => User::factory(),
            'montant' => fake()->randomElement([10000, 12500, 15000]),
            'mois' => ucfirst(mb_strtolower(\Illuminate\Support\Carbon::instance($date)->translatedFormat('F Y'))),
            'statut' => fake()->randomElement(['valide', 'valide', 'valide', 'en_attente']),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
