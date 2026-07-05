<?php

namespace Database\Seeders;

use App\Models\Commande;
use App\Models\DocumentPhysique;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommandeSeeder extends Seeder
{
    public function run(): void
    {
        $documents = DocumentPhysique::all();
        if ($documents->isEmpty()) {
            return;
        }

        $etudiants = User::where('role', 'etudiant')->get();

        foreach ($etudiants->random(min(8, $etudiants->count())) as $etudiant) {
            $document = $documents->random();

            Commande::create([
                'user_id' => $etudiant->id,
                'document_id' => $document->id,
                'quantite' => fake()->numberBetween(1, 3),
                'prix_unitaire' => $document->prix,
                'statut' => fake()->randomElement(['en_attente', 'confirmee', 'prete', 'livree']),
            ]);
        }
    }
}
