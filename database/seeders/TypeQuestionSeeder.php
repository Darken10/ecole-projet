<?php

namespace Database\Seeders;

use App\Models\Cours\TypeQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['QCMSipmle','QCM Multiple','Question Ouverte'];

        foreach ($data as $type) {
            TypeQuestion::create([
                'name'=>$type
            ]);
        }
    }
}
