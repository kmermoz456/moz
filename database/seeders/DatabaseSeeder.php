<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database avec des données de démonstration réalistes.
     */
    public function run(): void
    {
        $this->call([
            ParametreSeeder::class,
            UtilisateurSeeder::class,
            CoursSeeder::class,
            QuizSeeder::class,
            ContenuSeeder::class,
            PaiementSeeder::class,
            DocumentPhysiqueSeeder::class,
            CommandeSeeder::class,
            ProspectSeeder::class,
        ]);
    }
}
