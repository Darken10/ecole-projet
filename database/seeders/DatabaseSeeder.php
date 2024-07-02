<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ClasseSeeder;
use Database\Seeders\NiveauSeeder;
use Database\Seeders\StatutSeeder;
use Database\Seeders\MatiereSeeder;
use Database\Seeders\TypePieceJointSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();
        $this->call([
            StatutSeeder::class,
            ClasseSeeder::class,
            RoleSeeder::class,
            MatiereSeeder::class,
            TypePieceJointSeeder::class,
            NiveauSeeder::class,
            
        ]);

        
    }
}
