<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\RoleAssignment::factory(5)->create();
        \App\Models\RoleAssignment::create([
            'user_id'=>'1',
            'role_id'=>'1',
        ]);
        \App\Models\RoleAssignment::create([
            'user_id'=>'2',
            'role_id'=>'1',
        ]);
        \App\Models\RoleAssignment::create([
            'user_id'=>'3',
            'role_id'=>'2',
        ]);
        \App\Models\RoleAssignment::create([
            'user_id'=>'4',
            'role_id'=>'1',
        ]);
        \App\Models\RoleAssignment::create([
            'user_id'=>'5',
            'role_id'=>'3',
        ]);



    }
}
