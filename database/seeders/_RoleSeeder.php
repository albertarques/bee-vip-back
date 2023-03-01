<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Role::factory()->count(3)->create();
        \App\Models\Role::create([
            'role_name'=>'user',
        ]);
        \App\Models\Role::create([
            'role_name'=>'admin',
        ]);
        \App\Models\Role::create([
            'role_name'=>'superadmin',
        ]);
    }
}
