<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
  public function run()
  {
    Permission::create(['name' => 'approve-admin-users']);
    Permission::create(['name' => 'delete-admin-users']);
    Permission::create(['name' => 'create-users']);
    Permission::create(['name' => 'edit-users']);
    Permission::create(['name' => 'delete-users']);
    Permission::create(['name' => 'ban-users']);

    Permission::create(['name' => 'create-entrepreneurships']);
    Permission::create(['name' => 'approve-entrepreneurships']);
    Permission::create(['name' => 'edit-entrepreneurships']);
    Permission::create(['name' => 'delete-entrepreneurships']);

    $superAdminRole = Role::create(['name' => 'SuperAdmin']);
    $adminRole = Role::create(['name' => 'Admin']);
    // $userRole = Role::create(['name' => 'User']);

    $superAdminRole->givePermissionTo([
      'approve-admin-users',
      'delete-admin-users',
      'edit-users',
      'delete-users',
      'ban-users',
      'approve-entrepreneurships',
      'delete-entrepreneurships',
    ]);

    $adminRole->givePermissionTo([
      'create-entrepreneurships',
      'edit-entrepreneurships',
      'delete-entrepreneurships',
    ]);

    // $userRole->givePermissionTo([
    //   'edit-entrepreneurships',
    //   'delete-entrepreneurships',
    // ]);
  }
}
