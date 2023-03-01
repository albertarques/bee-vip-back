<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['name' => 'store']);
        // Permission::create(['name' => 'edit-me']);
        // Permission::create(['name' => 'delete-me']);

        // Permission::create(['name' => 'create-order']);
        // Permission::create(['name' => 'edit-order']);
        // Permission::create(['name' => 'delete-blog-posts']);

        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'superadmin']);

        $userRole->givePermissionTo([
            'store',
        //     'delete-users',
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        ]);

        // $adminRole->givePermissionTo([
        //     'create-users',
        //     'edit-users',
        //     'delete-users',
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        // ]);

        // $editorRole->givePermissionTo([
        //     'create-blog-posts',
        //     'edit-blog-posts',
        //     'delete-blog-posts',
        // ]);
    }
}
