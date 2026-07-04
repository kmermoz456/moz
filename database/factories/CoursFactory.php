<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoursFactory extends Factory
{
    private const MATIERES = [
        'L1' => ['Biologie cellulaire', 'Chimie générale', 'Géologie générale', 'Mathématiques', 'Physique'],
        'L2' => ['Biochimie structurale', 'Physiologie animale', 'Écologie', 'Chimie organique', 'Génétique'],
    ];

    private const CHAPITRES = [
        'Introduction et généralités', 'Fiche de cours', 'Exercices corrigés',
        'Travaux dirigés', 'Résumé et méthodologie', 'Annales corrigées',
    ];

    public function definition(): array
    {
        $niveau = fake()->randomElement(['L1', 'L2']);
        $matiere = fake()->randomElement(self::MATIERES[$niveau]);

        return [
            'titre' => $matiere.' — '.fake()->randomElement(self::CHAPITRES),
            'description' => fake()->sentence(15),
            'niveau' => $niveau,
            'matiere' => $matiere,
            // Closure : n'est évaluée (et ne génère un fichier) que si 'fichier_pdf'
            // n'est pas déjà fourni par un état comme pourNiveau().
            'fichier_pdf' => fn () => $this->genererPdfDemo($matiere),
            'gratuit' => fake()->boolean(30),
            'telechargements' => fake()->numberBetween(0, 120),
        ];
    }

    /**
     * Fixe le niveau et choisit une matière cohérente avec ce niveau.
     */
    public function pourNiveau(string $niveau): static
    {
        return $this->state(function () use ($niveau) {
            $matiere = fake()->randomElement(self::MATIERES[$niveau]);

            return [
                'niveau' => $niveau,
                'matiere' => $matiere,
                'titre' => $matiere.' — '.fake()->randomElement(self::CHAPITRES),
                'fichier_pdf' => $this->genererPdfDemo($matiere),
            ];
        });
    }

    private function genererPdfDemo(string $matiere): string
    {
        $path = 'cours/'.Str::uuid().'.pdf';

        $contenu = <<<PDF
        %PDF-1.4
        1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj
        2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj
        3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 210 297]/Contents 4 0 R/Resources<</Font<</F1 5 0 R>>>>>>endobj
        4 0 obj<</Length 90>>stream
        BT /F1 16 Tf 30 250 Td (ITF - Support de cours) Tj 0 -30 Td ({$matiere}) Tj ET
        endstream
        endobj
        5 0 obj<</Type/Font/Subtype/Type1/BaseFont/Helvetica>>endobj
        trailer<</Size 6/Root 1 0 R>>
        %%EOF
        PDF;

        Storage::disk('local')->put($path, $contenu);

        return $path;
    }
}
