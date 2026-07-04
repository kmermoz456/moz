<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActualiteFactory extends Factory
{
    private const ACTUALITES = [
        ['titre' => 'Ouverture des inscriptions pour la nouvelle promotion', 'contenu' => 'ITF ouvre les inscriptions pour les nouveaux bacheliers orientés en Sciences de la Nature à l\'UNA. Un mois de renforcement gratuit est offert à tous les nouveaux inscrits.'],
        ['titre' => 'Sessions de révision intensive avant les partiels', 'contenu' => 'Des séances de révision renforcées sont organisées pour préparer au mieux les étudiants de Licence 1 et Licence 2 aux examens de fin de semestre.'],
        ['titre' => 'Nouveaux quiz interactifs disponibles', 'contenu' => 'De nouveaux quiz ont été ajoutés à l\'espace étudiant pour vous permettre de tester vos connaissances en biologie, chimie et géologie.'],
        ['titre' => 'Bilan de la dernière promotion : un taux de réussite record', 'contenu' => 'La dernière promotion accompagnée par ITF affiche un taux de réussite exceptionnel aux examens de l\'UFR Sciences de la Nature.'],
        ['titre' => 'Rejoignez la communauté ITF sur WhatsApp', 'contenu' => 'Le groupe WhatsApp officiel d\'ITF permet de rester informé des annonces importantes, cours et conseils d\'orientation en temps réel.'],
    ];

    public function definition(): array
    {
        $actualite = fake()->randomElement(self::ACTUALITES);

        return [
            'titre' => $actualite['titre'],
            'contenu' => $actualite['contenu'],
            'image' => null,
            'publie' => fake()->boolean(90),
        ];
    }
}
