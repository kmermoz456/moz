<?php

namespace Database\Seeders;

use App\Models\Parametre;
use Illuminate\Database\Seeder;

class ParametreSeeder extends Seeder
{
    public function run(): void
    {
        $parametres = [
            'taux_reussite' => 92,
            'taux_satisfaction' => 95,
            'nombre_enseignants' => 15,
            'annees_experience' => now()->year - 2021,
            'whatsapp_lien' => 'https://chat.whatsapp.com/ITFDemoGroupLink',
            'places_disponibles' => 12,
        ];

        foreach ($parametres as $cle => $valeur) {
            Parametre::updateOrCreate(['cle' => $cle], ['valeur' => $valeur]);
        }
    }
}
