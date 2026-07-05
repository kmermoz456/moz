<?php

namespace Database\Seeders;

use App\Models\Actualite;
use App\Models\Galerie;
use App\Models\Temoignage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContenuSeeder extends Seeder
{
    private const PHOTOS_UNSPLASH = [
        '1522202176988-66273c2fd55f', '1523240795612-9a054b0db644', '1517245386807-bb43f82c33c4',
        '1529390079861-591de354faf5', '1600880292203-757bb62b4baf', '1543269865-cbf427effbad',
        '1571260899304-425eee4c7efc', '1531482615713-2afd69097998', '1633332755192-727a05c4013d',
        '1517841905240-472988babdf9', '1544717297-fa95b6ee9643', '1580489944761-15a19d654956',
    ];

    public function run(): void
    {
        $photos = $this->telechargerPhotos('demo', count(self::PHOTOS_UNSPLASH));

        $superAdmin = User::where('email', 'admin@itf.ci')->value('id');
        $autreAdmin = User::where('email', 'marie.kouassi@itf.ci')->value('id');

        Temoignage::factory()->count(8)->sequence(fn ($sequence) => [
            'photo' => $photos[$sequence->index % count($photos)] ?? null,
            'cree_par_id' => $sequence->index % 2 === 0 ? $superAdmin : $autreAdmin,
        ])->create();

        Actualite::factory()->count(5)->sequence(fn ($sequence) => [
            'image' => $photos[($sequence->index + 3) % count($photos)] ?? null,
            'cree_par_id' => $sequence->index % 2 === 0 ? $superAdmin : $autreAdmin,
        ])->create();

        Galerie::factory()->count(10)->sequence(fn ($sequence) => [
            'image' => $photos[$sequence->index % count($photos)] ?? null,
            'cree_par_id' => $sequence->index % 2 === 0 ? $superAdmin : $autreAdmin,
        ])->create();
    }

    /**
     * Télécharge quelques photos Unsplash pour peupler la galerie, les témoignages et les actualités.
     * En cas d'échec réseau, les modèles garderont simplement une image vide (dégradation silencieuse).
     *
     * @return array<int, string>
     */
    private function telechargerPhotos(string $dossier, int $limite): array
    {
        $chemins = [];

        foreach (array_slice(self::PHOTOS_UNSPLASH, 0, $limite) as $id) {
            try {
                $reponse = Http::timeout(10)->get("https://images.unsplash.com/photo-{$id}", [
                    'w' => 800, 'q' => 60, 'fit' => 'crop', 'auto' => 'format',
                ]);

                if ($reponse->successful()) {
                    $chemin = $dossier.'/'.Str::uuid().'.jpg';
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
