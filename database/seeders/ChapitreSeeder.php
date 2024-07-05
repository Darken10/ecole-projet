<?php

namespace Database\Seeders;

use App\Models\Cours\Partie\Chapitre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapitreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chapitre::factory(10)->create();
    }
}
