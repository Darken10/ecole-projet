<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = ['Français','Anglais','Histoire-Géographie','Physique-Chimique','Mathematique','Philosophie','SVT'];

        foreach ($table as $key => $value) {
            Matiere::create([
                'name'=>$value,
            ]);
        }
    }
}
