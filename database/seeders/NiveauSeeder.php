<?php

namespace Database\Seeders;

use App\Models\Matiere;
use App\Models\Cours\Niveau;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $index = 0;
        $m1 = [];
        $m2 = [];
        $m3 = [];
        $i = 0;
        foreach (Matiere::all() as $value) {
           if($i<=4){
                $m1[] = $value->id;
                $m2[] = $value->id;
                $m3[] = $value->id;
           }else if($i>4 and $i<6 ){
                $m2[] = $value->id;
                $m3[] = $value->id;
           }
           else{
                $m3[] = $value->id;
           }
           $i++;
        }

        $data = ['6eme','5eme','4eme','3eme','2nd A','2nd C','1eme A','1eme C','1eme D','Tle A','Tle C','Tle D'];
        foreach ($data as $key => $value) {
            $n = Niveau::create([
                'name'=>$value,
                'difficulty'=> $key+1,
            ]);
            if($index < 2){
                $n->matieres()->attach($m1);
            }if($index >= 2 and $index<=3){
                $n->matieres()->attach($m2);
            }else{
                $n->matieres()->attach($m3);
            }

            $index ++;
        }
    }
}
