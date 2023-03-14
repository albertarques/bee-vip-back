<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Permissions\Permission as MyPermission;

class RoleAndPermissionSeeder extends Seeder
{
  public function run(){
    // Users Permissions Seeder

      // User
      Permission::create(['name' => MyPermission::CAN_UPDATE_MY_USER_PROFILE]);
      Permission::create(['name' => MyPermission::CAN_DELETE_MY_USER_PROFILE]);
      Permission::create(['name' => MyPermission::CAN_UPDATE_USER_PROFILE]);

      //Superadmin
      Permission::create(['name' => MyPermission::CAN_DELETE_USER]);
      Permission::create(['name' => MyPermission::CAN_UPDATE_USER_ROLE]);

    // Payment Methods Permissions Seeder
      Permission::create(['name' => MyPermission::CAN_CREATE_PAYMENT_METHOD]);
      Permission::create(['name' => MyPermission::CAN_DELETE_PAYMENT_METHOD]);
      Permission::create(['name' => MyPermission::CAN_SHOW_PAYMENT_METHOD]);
      Permission::create(['name' => MyPermission::CAN_VIEW_PAYMENT_METHODS]);
      Permission::create(['name' => MyPermission::CAN_UPDATE_PAYMENT_METHOD]);

    // Orders Permissions Seeder
      Permission::create(['name' => MyPermission::CAN_CREATE_ORDER]);
      Permission::create(['name' => MyPermission::CAN_VIEW_ORDERS]);
      Permission::create(['name' => MyPermission::CAN_SHOW_ORDER]);
      Permission::create(['name' => MyPermission::CAN_UPDATE_ORDER]);
      Permission::create(['name' => MyPermission::CAN_DELETE_ORDER]);

    // Order details Permissions Seeder
      Permission::create(['name' => MyPermission::CAN_CREATE_ORDER_DETAIL]);

    // Entrepreneurships Permissions Seeder
      Permission::create(['name' => MyPermission::CAN_CREATE_ENTREPRENEURSHIP]);
      Permission::create(['name' => MyPermission::CAN_DELETE_MY_ENTREPRENEURSHIP]);
      Permission::create(['name' => MyPermission::CAN_UPDATE_MY_ENTREPRENEURSHIP]);
      Permission::create(['name' => MyPermission::CAN_VIEW_MY_ENTREPRENEURSHIPS]);

      Permission::create(['name' => MyPermission::CAN_DELETE_ENTREPRENEURSHIP]);
      Permission::create(['name' => MyPermission::CAN_INSPECT_ENTREPRENEURSHIP]);
      Permission::create(['name' => MyPermission::CAN_VIEW_PENDING_ENTREPRENEURSHIPS]);

    // Comments Permissions Seeder
      Permission::create(['name' => MyPermission::CAN_CREATE_COMMENT]);
      Permission::create(['name' => MyPermission::CAN_UPDATE_MY_COMMENT]);
      Permission::create(['name' => MyPermission::CAN_DELETE_MY_COMMENT]);
      Permission::create(['name' => MyPermission::CAN_DELETE_COMMENT]);

    // Categories
      Permission::create(['name' => MyPermission::CAN_CREATE_CATEGORY]);
      Permission::create(['name' => MyPermission::CAN_UPDATE_CATEGORY]);
      Permission::create(['name' => MyPermission::CAN_DELETE_CATEGORY]);

    // *****************************************************************
    // Role Names Seeder
      $userRole = Role::create(['name' => 'user']);
      $adminRole = Role::create(['name' => 'admin']);
      $superadminRole = Role::create(['name' => 'superadmin']);

    // *****************************************************************
    // Assign Permissions to Roles
      $userRole->givePermissionTo([
        // User Profile
          MyPermission::CAN_UPDATE_MY_USER_PROFILE,
          MyPermission::CAN_DELETE_MY_USER_PROFILE,
          // MyPermission::CAN_UPDATE_USER_PROFILE,

        // Payment Methods
          MyPermission::CAN_CREATE_PAYMENT_METHOD,
          MyPermission::CAN_DELETE_PAYMENT_METHOD,
          MyPermission::CAN_SHOW_PAYMENT_METHOD,
          MyPermission::CAN_VIEW_PAYMENT_METHODS,
          MyPermission::CAN_UPDATE_PAYMENT_METHOD,

        // Orders
          MyPermission::CAN_CREATE_ORDER,
          MyPermission::CAN_SHOW_ORDER,
          MyPermission::CAN_VIEW_ORDERS,

        // Order details
          MyPermission::CAN_CREATE_ORDER_DETAIL,

        // Comments
          MyPermission::CAN_CREATE_COMMENT,
          MyPermission::CAN_UPDATE_MY_COMMENT,
          MyPermission::CAN_DELETE_MY_COMMENT,
      ]);

      $adminRole->givePermissionTo([
        // User Profile
          MyPermission::CAN_UPDATE_MY_USER_PROFILE,
          MyPermission::CAN_DELETE_MY_USER_PROFILE,
          MyPermission::CAN_UPDATE_USER_PROFILE,

        // Payment Methods
          MyPermission::CAN_CREATE_PAYMENT_METHOD,
          MyPermission::CAN_DELETE_PAYMENT_METHOD,
          MyPermission::CAN_SHOW_PAYMENT_METHOD,
          MyPermission::CAN_VIEW_PAYMENT_METHODS,
          MyPermission::CAN_UPDATE_PAYMENT_METHOD,

        // Entrepreneurships
          MyPermission::CAN_CREATE_ENTREPRENEURSHIP,
          MyPermission::CAN_DELETE_MY_ENTREPRENEURSHIP,
          MyPermission::CAN_UPDATE_MY_ENTREPRENEURSHIP,
          MyPermission::CAN_VIEW_MY_ENTREPRENEURSHIPS,
        // Orders
          MyPermission::CAN_CREATE_ORDER,
          MyPermission::CAN_SHOW_ORDER,
          MyPermission::CAN_VIEW_ORDERS,
        // Order details
          MyPermission::CAN_CREATE_ORDER_DETAIL,
        // Comments
          MyPermission::CAN_CREATE_COMMENT,
          MyPermission::CAN_UPDATE_MY_COMMENT,
          MyPermission::CAN_DELETE_MY_COMMENT,

      ]);

      $superadminRole->givePermissionTo([
        // User Profile
          MyPermission::CAN_UPDATE_MY_USER_PROFILE,
          MyPermission::CAN_DELETE_MY_USER_PROFILE,
          MyPermission::CAN_UPDATE_USER_PROFILE,

        // Users
          MyPermission::CAN_DELETE_USER,
          MyPermission::CAN_UPDATE_USER_ROLE,

        // Payment Methods
          MyPermission::CAN_CREATE_PAYMENT_METHOD,
          MyPermission::CAN_DELETE_PAYMENT_METHOD,
          MyPermission::CAN_SHOW_PAYMENT_METHOD,
          MyPermission::CAN_VIEW_PAYMENT_METHODS,
          MyPermission::CAN_UPDATE_PAYMENT_METHOD,

        // Entrepreneurships
          MyPermission::CAN_CREATE_ENTREPRENEURSHIP,
          MyPermission::CAN_DELETE_MY_ENTREPRENEURSHIP,
          MyPermission::CAN_UPDATE_MY_ENTREPRENEURSHIP,
          MyPermission::CAN_VIEW_MY_ENTREPRENEURSHIPS,

          MyPermission::CAN_DELETE_ENTREPRENEURSHIP,
          MyPermission::CAN_INSPECT_ENTREPRENEURSHIP,
          MyPermission::CAN_VIEW_PENDING_ENTREPRENEURSHIPS,

        // Orders
          MyPermission::CAN_CREATE_ORDER,
          MyPermission::CAN_SHOW_ORDER,
          MyPermission::CAN_VIEW_ORDERS,

        // Order details
          MyPermission::CAN_CREATE_ORDER_DETAIL,

        // Comments
          MyPermission::CAN_CREATE_COMMENT,
          MyPermission::CAN_UPDATE_MY_COMMENT,
          MyPermission::CAN_DELETE_MY_COMMENT,

          MyPermission::CAN_DELETE_COMMENT,

        // Categories
          MyPermission::CAN_CREATE_CATEGORY,
          MyPermission::CAN_UPDATE_CATEGORY,
          MyPermission::CAN_DELETE_CATEGORY,
      ]);
  }
}
