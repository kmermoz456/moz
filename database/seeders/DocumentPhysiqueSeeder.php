<?php

namespace Database\Seeders;

use App\Models\DocumentPhysique;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentPhysiqueSeeder extends Seeder
{
    private const PHOTOS_UNSPLASH = [
        '1544716278-ca5e3f4abd8c', '1512820790803-83ca734da794',
        '1481627834876-b7833e8f5570', '1519681393784-d120267933ba',
    ];

    private const CATALOGUE = [
        ['titre' => "Recueil d'anciens sujets — Biologie cellulaire (L1)", 'categorie' => "Recueil d'anciens sujets", 'niveau' => 'L1', 'prix' => 2000, 'description' => "Sujets d'examens des 5 dernières années avec corrigés détaillés."],
        ['titre' => "Recueil d'anciens sujets — Chimie générale (L1)", 'categorie' => "Recueil d'anciens sujets", 'niveau' => 'L1', 'prix' => 2000, 'description' => "Sujets d'examens des 5 dernières années avec corrigés détaillés."],
        ['titre' => "Recueil d'anciens sujets — Biochimie structurale (L2)", 'categorie' => "Recueil d'anciens sujets", 'niveau' => 'L2', 'prix' => 2500, 'description' => "Sujets d'examens des 5 dernières années avec corrigés détaillés."],
        ['titre' => "Recueil d'anciens sujets — Écologie (L2)", 'categorie' => "Recueil d'anciens sujets", 'niveau' => 'L2', 'prix' => 2500, 'description' => "Sujets d'examens des 5 dernières années avec corrigés détaillés."],
        ['titre' => 'Fiche de révision — Méthodologie UE (Tous niveaux)', 'categorie' => 'Fiche de révision', 'niveau' => 'Tous', 'prix' => 1000, 'description' => 'Synthèse des méthodes de travail et astuces pour réussir ses examens.'],
        ['titre' => 'Livret de travaux dirigés — Mathématiques (L1)', 'categorie' => 'Livret de TD', 'niveau' => 'L1', 'prix' => 1500, 'description' => 'Exercices corrigés pas à pas pour consolider les bases.'],
        ['titre' => 'Livret de travaux dirigés — Génétique (L2)', 'categorie' => 'Livret de TD', 'niveau' => 'L2', 'prix' => 1500, 'description' => 'Exercices corrigés pas à pas pour consolider les bases.'],
    ];

    public function run(): void
    {
        $photos = $this->telechargerPhotos();
        $superAdmin = User::where('email', 'admin@itf.ci')->value('id');
        $autreAdmin = User::where('email', 'marie.kouassi@itf.ci')->value('id');

        foreach (self::CATALOGUE as $i => $item) {
            DocumentPhysique::create($item + [
                'image' => $photos[$i % max(1, count($photos))] ?? null,
                'disponible' => true,
                'cree_par_id' => $i % 2 === 0 ? $superAdmin : $autreAdmin,
            ]);
        }
    }

    /**
     * @return array<int, string>
     */
    private function telechargerPhotos(): array
    {
        $chemins = [];

        foreach (self::PHOTOS_UNSPLASH as $id) {
            try {
                $reponse = Http::timeout(10)->get("https://images.unsplash.com/photo-{$id}", [
                    'w' => 800, 'q' => 60, 'fit' => 'crop', 'auto' => 'format',
                ]);

                if ($reponse->successful()) {
                    $chemin = 'documents/'.Str::uuid().'.jpg';
                    Storage::disk('public')->put($chemin, $reponse->body());
                    $chemins[] = $chemin;
                }
            } catch (\Throwable) {
                // Pas de connexion internet disponible : on continue sans image.
            }
        }

        return $chemins;
    }
}
