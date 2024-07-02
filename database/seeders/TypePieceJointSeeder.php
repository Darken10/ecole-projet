<?php

namespace Database\Seeders;

use App\Models\Cours\TypePieceJoint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypePieceJointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['image','video','video_link','pdf','doc','audio','link'];

        foreach ($data as $type) {
            TypePieceJoint::create([
                'name'=>$type
            ]);
        }
    }
}
