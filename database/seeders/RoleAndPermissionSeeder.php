<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Permissions\Permission as MyPermission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['name' => MyPermission::CAN_CREATE_BUSINESS]);
        // Permission::create(['name' => 'edit-me']);
        // Permission::create(['name' => 'delete-me']);

        // Permission::create(['name' => 'create-order']);
        // Permission::create(['name' => 'edit-order']);
        // Permission::create(['name' => 'delete-blog-posts']);

        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);
        $superadminRole = Role::create(['name' => 'superadmin']);

        $userRole->givePermissionTo([
        //     'store',
        //     'delete-users',
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        ]);

        $adminRole->givePermissionTo([
            MyPermission::CAN_CREATE_BUSINESS,
        //     'create-users',
        //     'edit-users',
        //     'delete-users',
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        ]);

        $superadminRole->givePermissionTo([
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        ]);
    }
}
