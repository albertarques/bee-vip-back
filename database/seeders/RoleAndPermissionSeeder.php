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
        // ************* User permissions ***********************************
        // User Profile
        Permission::create(['name' => MyPermission::CAN_UPDATE_USERPROFILE]);
        Permission::create(['name' => MyPermission::CAN_DELETE_USERPROFILE]);

        // Payment Methods
        Permission::create(['name' => MyPermission::CAN_CREATE_PAYMENTMETHOD]);
        Permission::create(['name' => MyPermission::CAN_VIEW_PAYMENTMETHOD]);
        Permission::create(['name' => MyPermission::CAN_UPDATE_PAYMENTMETHOD]);
        Permission::create(['name' => MyPermission::CAN_DELETE_PAYMENTMETHOD]);

        // Orders
        Permission::create(['name' => MyPermission::CAN_CREATE_ORDER]);
        Permission::create(['name' => MyPermission::CAN_VIEW_ORDER]);

        // Order details
        Permission::create(['name' => MyPermission::CAN_CREATE_ORDER_DETAIL]);
        Permission::create(['name' => MyPermission::CAN_VIEW_ORDER_DETAIL]);

        // Comment Entrepreneurships
        Permission::create(['name' => MyPermission::CAN_CREATE_COMMENT]);

        // ************* Admin permissions ***********************************
        // Entrepreneurships
        Permission::create(['name' => MyPermission::CAN_CREATE_ENTREPRENEURSHIP]);
        Permission::create(['name' => MyPermission::CAN_UPDATE_ENTREPRENEURSHIP]);
        Permission::create(['name' => MyPermission::CAN_DELETE_ENTREPRENEURSHIP]);
        Permission::create(['name' => MyPermission::CAN_VIEW_PENDING_ENTREPRENEURSHIPS]);

        // ************* Superadmin permissions ******************************
        // Entrepreneurships
        Permission::create(['name' => MyPermission::CAN_APPROVE_ENTREPRENEURSHIPS]);

        //Users
        Permission::create(['name' => MyPermission::CAN_APPROVE_USERTOADMIN]);


        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);
        $superadminRole = Role::create(['name' => 'superadmin']);

        $userRole->givePermissionTo([
            // User Profile
            MyPermission::CAN_UPDATE_USERPROFILE,
            MyPermission::CAN_DELETE_USERPROFILE,

            // Payment Methods
            MyPermission::CAN_CREATE_PAYMENTMETHOD,
            MyPermission::CAN_VIEW_PAYMENTMETHOD,
            MyPermission::CAN_UPDATE_PAYMENTMETHOD,
            MyPermission::CAN_DELETE_PAYMENTMETHOD,

            // Orders
            MyPermission::CAN_CREATE_ORDER,
            MyPermission::CAN_VIEW_ORDER,

            // Order details
            MyPermission::CAN_CREATE_ORDER_DETAIL,
            MyPermission::CAN_VIEW_ORDER_DETAIL,

            // Comment Entrepreneurships
            MyPermission::CAN_CREATE_COMMENT,
        ]);

        $adminRole->givePermissionTo([
            $userRole,

            // Entrepreneurships
            MyPermission::CAN_CREATE_ENTREPRENEURSHIP,
            MyPermission::CAN_UPDATE_ENTREPRENEURSHIP,
            MyPermission::CAN_DELETE_ENTREPRENEURSHIP,
            MyPermission::CAN_VIEW_PENDING_ENTREPRENEURSHIPS,

        ]);

        $superadminRole->givePermissionTo([
            $adminRole,
            // Roles
            MyPermission::CAN_APPROVE_USERTOADMIN,

            // Entrepreneurships
            MyPermission::CAN_APPROVE_ENTREPRENEURSHIPS,
            MyPermission::CAN_VIEW_PENDING_ENTREPRENEURSHIPS,
        ]);
    }
}
