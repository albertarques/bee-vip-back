<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadminRole = Role::where('name', 'superadmin')->first();

        // Crear un usuario administrador
        User::create([
            'username' => 'Albert',
            'email' => 'albertarques@gmail.com',
            'phone' => '666666666',
            'password' => bcrypt('12345678'),
        ]);

        $superadminUser = User::find(1);

        // Asignar el rol de administrador al usuario
        $superadminUser->assignRole($superadminRole);
        $superadminUser->syncRoles($superadminRole);

        \App\Models\User::factory(10)->create();

        User::factory()->create([
          "username" => "user",
          "email" => "user@example.com",
          "phone" => "111111111",
          "password" => "12345678"
        ]);

        User::factory()->create([
          "username" => "admin",
          "email" => "admin@example.com",
          "phone" => "222222222",
          "password" => "12345678"
        ]);

        User::factory()->create([
          "username" => "superadmin",
          "email" => "superadmin@example.com",
          "phone" => "333333333",
          "password" => "12345678"
        ]);

    }
}
