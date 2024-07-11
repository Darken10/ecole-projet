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

        $user = User::create([
            'name' => 'Darken Root',
            'last_name' => 'Darken',
            'first_name' => 'Root',
            'sexe' => 'Homme',
            'numero' => '70707070',
            'date_naissance' => now(),
            'email' => 'darken@darken.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('password'),
            'remember_token' => Str::random(10),
            'statut_id' => 1,
            'niveau_id'=> 12,
        ]);

        $user = User::create([
            'name' => 'Darken1 Root1',
            'last_name' => 'Darken1',
            'first_name' => 'Root1',
            'sexe' => 'Homme',
            'numero' => '70707071',
            'date_naissance' => now(),
            'email' => 'darken1@darken.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('password'),
            'remember_token' => Str::random(10),
            'statut_id' => 1,
            'niveau_id' => 3,
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
        $user->roles()->attach([1,2,3,4]);
        $user->roles()->attach([1]);

    }
}
