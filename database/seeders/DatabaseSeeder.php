<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\ClasseSeeder;
use Database\Seeders\LessonSeeder;
use Database\Seeders\NiveauSeeder;
use Database\Seeders\StatutSeeder;
use Database\Seeders\MatiereSeeder;
use Database\Seeders\ChapitreSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\TypeQuestionSeeder;
use Database\Seeders\TypePieceJointSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //User::factory(10)->create();

        User::create([
            'name' => 'Darken',
            'email' => 'darken@darken.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $this->call([
            StatutSeeder::class,
            ClasseSeeder::class,
            RoleSeeder::class,
            MatiereSeeder::class,
            TypePieceJointSeeder::class,
            NiveauSeeder::class,
            TypeQuestionSeeder::class,
            ChapitreSeeder::class,
            LessonSeeder::class,
        ]);
    }
}
