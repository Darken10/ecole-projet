<?php

namespace Database\Seeders;

use App\Models\Admin\Classe\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = ['6éme','5éme','4éme','3éme','2nde','1ère','Tle'];
        foreach ($table as $key => $value) {
            Classe::create([
                'name'=> $value               
            ]);
        }
    }
}
