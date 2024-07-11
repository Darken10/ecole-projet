<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cours\Partie\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::factory(50)->create();
    }
}
