<?php

namespace Database\Seeders;

use App\Models\Cours;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoursSeeder extends Seeder
{
    public function run(): void
    {
        // Répartis entre les deux administrateurs de démo pour illustrer l'isolation du contenu
        $superAdmin = User::where('email', 'admin@itf.ci')->value('id');
        $autreAdmin = User::where('email', 'marie.kouassi@itf.ci')->value('id');

        Cours::factory()->count(10)->pourNiveau('L1')->create(['cree_par_id' => $superAdmin]);
        Cours::factory()->count(10)->pourNiveau('L2')->create(['cree_par_id' => $autreAdmin]);
    }
}
