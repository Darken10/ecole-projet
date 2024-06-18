<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = ['user','admin','root','prof'];
        foreach ($table as $key => $value) {
            Role::create([
                'name'=> $value
            ]);
        }
    }
}
