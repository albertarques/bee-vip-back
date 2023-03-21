<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

        // Crear un usuario administrador, id 1
        User::create([
            'username' => 'Albert',
            'picture' => 'images/default/default-user.png',
            'email' => 'albertarques@gmail.com',
            'phone' => '666666666',
            'password' => Hash::make('12345678'),
        ]);

        // Crear un usuario administrador, id 2
        User::factory()->create([
          'username' => 'user',
          'picture' => 'images/default/default-user.png',
          'email' => 'user@example.com',
          'phone' => '111111111',
          'password' => Hash::make('12345678')
        ]);

        // Crear un usuario administrador, id 3
        User::factory()->create([
          'username' => 'admin',
          'picture' => 'images/default/default-user.png',
          'email' => 'admin@example.com',
          'phone' => '222222222',
          'password' => Hash::make('12345678')
        ]);

        // Crear un usuario administrador, id 4
        User::factory()->create([
          'username' => 'superadmin',
          'picture' => 'images/default/default-user.png',
          'email' => 'superadmin@example.com',
          'phone' => '333333333',
          'password' => Hash::make('12345678')
        ]);

        $userRole = Role::where('name', 'user')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $superadminRole = Role::where('name', 'superadmin')->first();

        $albertUser = User::find(1);
        $userUser = User::find(2);
        $adminUser = User::find(3);
        $superadminUser = User::find(4);

        // Asignar el rol de administrador al usuario Albert
        $albertUser->assignRole($superadminRole);
        $albertUser->syncRoles($superadminRole);

        $userUser->assignRole($userRole);
        $userUser->syncRoles($userRole);

        $adminUser->assignRole($adminRole);
        $adminUser->syncRoles($adminRole);

        $superadminUser->assignRole($superadminRole);
        $superadminUser->syncRoles($superadminRole);

        \App\Models\User::factory(10)->create();

    }
}
