<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TemoignageFactory extends Factory
{
    private const PRENOMS = ['Aya', 'Kouassi', 'Adjoua', 'Yao', 'Awa', 'Koffi', 'Mariam', 'Ismael', 'Affoué', 'Serge'];
    private const NOMS = ['Kouadio', 'Traoré', 'Koné', 'Ouattara', 'Bamba', 'Diabaté', 'Coulibaly', 'Kra', 'Assi'];

    private const AVIS = [
        'Grâce à ITF, j\'ai enfin compris la biologie cellulaire. Les cours sont clairs et les enseignants toujours disponibles.',
        'Le suivi personnalisé m\'a permis de valider mon premier semestre sans difficulté. Je recommande à tous les nouveaux bacheliers.',
        'Les quiz interactifs m\'ont beaucoup aidé à réviser avant les examens. Un vrai plus par rapport aux cours classiques.',
        'Sans ITF, je pense que j\'aurais eu beaucoup plus de mal à m\'adapter à l\'université dès la première année.',
        'Les exercices corrigés et les examens blancs m\'ont préparé exactement comme il fallait pour les partiels.',
        'Une équipe à l\'écoute sur WhatsApp, disponible même tard le soir pour répondre à nos questions.',
        'J\'ai amélioré mes notes en chimie organique dès le premier mois de renforcement.',
        'Le mois gratuit m\'a permis de tester sans risque, et j\'ai tout de suite vu la différence dans mes résultats.',
    ];

    public function definition(): array
    {
        $niveau = fake()->randomElement(['1', '2']);

        return [
            'nom' => fake()->randomElement(self::PRENOMS).' '.fake()->randomElement(self::NOMS),
            'promotion' => 'Licence '.$niveau.' — '.fake()->numberBetween(2024, 2026),
            'contenu' => fake()->randomElement(self::AVIS),
            'photo' => null,
            'publie' => fake()->boolean(85),
        ];
    }
}
