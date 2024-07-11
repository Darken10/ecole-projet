<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = ['Français','Anglais','Histoire-Géographie','Mathematique','SVT','Allemand','Physique-Chimique','Philosophie'];

        foreach ($table as $key => $value) {
            Matiere::create([
                'name'=>$value,
            ]);
        }
    }
}
