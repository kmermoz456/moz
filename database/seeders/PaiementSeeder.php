<?php

namespace Database\Seeders;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Database\Seeder;

class PaiementSeeder extends Seeder
{
    public function run(): void
    {
        $etudiants = User::where('role', 'etudiant')->get();

        foreach ($etudiants->random(min(15, $etudiants->count())) as $etudiant) {
            Paiement::factory()
                ->count(fake()->numberBetween(1, 3))
                ->create(['user_id' => $etudiant->id]);
        }
    }
}
