<?php

namespace Database\Seeders;

use App\Models\Cours;
use Illuminate\Database\Seeder;

class CoursSeeder extends Seeder
{
    public function run(): void
    {
        Cours::factory()->count(10)->pourNiveau('L1')->create();
        Cours::factory()->count(10)->pourNiveau('L2')->create();
    }
}
