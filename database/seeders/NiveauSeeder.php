<?php

namespace Database\Seeders;

use App\Models\Cours\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['CP1','CP2','CE1','CE2','CM1','CM2','6eme','5eme','4eme','3eme','2nd','1eme','Tle'];
        foreach ($data as $key => $value) {
            Niveau::create([
                'name'=>$value,
                'difficulty'=> $key+1,
            ]);
        }
    }
}
