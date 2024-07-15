<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cours\TypePieceJoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypePieceJointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['image','video','document','audio'];

        foreach ($data as $type) {
            TypePieceJoint::create([
                'name'=>$type
            ]);
        }
    }
}
