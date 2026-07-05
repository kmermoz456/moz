<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin',
            'prenoms' => 'ITF',
            'email' => 'admin@itf.ci',
            'telephone' => '0700000000',
            'est_super_admin' => true,
        ]);

        // Second administrateur (non super admin) pour démontrer l'isolation du contenu
        User::factory()->admin()->create([
            'name' => 'Kouassi',
            'prenoms' => 'Marie',
            'email' => 'marie.kouassi@itf.ci',
            'telephone' => '0700000001',
        ]);

        // Étudiants avec essai gratuit encore actif
        User::factory()->count(12)->essaiActif()->create();

        // Étudiants dont l'essai gratuit est terminé (certains ont payé, cf. PaiementSeeder)
        User::factory()->count(13)->essaiExpire()->create();
    }
}
