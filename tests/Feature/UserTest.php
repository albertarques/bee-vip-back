<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

class UserTest extends TestCase
{

  public function setUp(): void {
    parent::setUp();
    Artisan::call('migrate:fresh --seed --env=testing');

    $this->post('api/register', [
      'username' => 'test user',
      'email' => 'testuser@example.com',
      'password' => '12345678',
      'phone' => '000111222'
    ]);

    $this->post('api/register', [
      'username' => 'user admin',
      'email' => 'useradmin@example.com',
      'password' => '12345678',
      'phone' => '000222333'
    ]);

    $adminRole = Role::where('name', 'admin')->first();
    $admin = User::where('username', 'user admin')->first();

    $admin->assignRole($adminRole);

    $this->post('api/register', [
      'username' => 'user superadmin',
      'email' => 'usersuperadmin@example.com',
      'password' => '12345678',
      'phone' => '000333444'
    ]);

    $superadminRole = Role::where('name', 'superadmin')->first();
    $superadmin = User::where('username', 'user superadmin')->first();

    $superadmin->assignRole($superadminRole);
  }

  // //api/register
  // /** @test*/
  // public function ok_is_returned_if_user_user_register_are_completed(){
  //   $response = $this->post('api/register', [
  //     'username' => 'test user register',
  //     'email' => 'testuserregister@example.com',
  //     'password' => '12345678',
  //     'phone' => '999111222'
  //   ]);

  //   $response->assertStatus(200);

  //   $this->assertDatabaseHas('users', [
  //     'email' => 'testuserregister@example.com',
  //   ]);
  // }

  // /** @test*/
  // public function ok_is_returned_if_user_admin_exists(){

  //   $this->assertDatabaseHas('users', [
  //     'email' => 'useradmin@example.com',
  //   ]);
  // }

  // /** @test*/
  // public function ok_is_returned_if_user_superadmin_exists(){

  //   $this->assertDatabaseHas('users', [
  //     'email' => 'usersuperadmin@example.com',
  //   ]);

  // }

  // //api/login
  // /** @test*/
  // public function ok_is_returned_if_user_can_login(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $response->assertStatus(200);
  // }

  // /** @test*/
  // public function ok_is_returned_if_user_can_refresh(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $token = $response->original['authorisation']['token'];

  //   $response = $this->post('api/refresh', [
  //     'token' => $token
  //   ]);

  //   $response->assertStatus(200);
  // }

  // //api/logout
  // /** @test*/
  // public function ok_is_returned_if_user_can_logout(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $token = $response->original['authorisation']['token'];

  //   $response = $this->post('api/logout', [
  //     'token' => $token
  //   ]);

  //   $response->assertStatus(200);
  // }

  // //api/me
  // /** @test*/
  // public function ok_is_returned_if_user_can_see_his_profile(){

  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $token = $response->original['authorisation']['token'];

  //   $response = $this->post('api/me', [
  //     'token' => $token,
  //   ]);

  //   $response->assertStatus(200);
  // }

  // /** @test*/
  // public function ok_is_returned_if_user_can_be_assigned_admin_role(){

  //   $user = User::where('username', 'test user')->first();

  //   $adminRole = Role::findByName('admin');

  //   $user->assignRole($adminRole);

  //   $this->assertTrue($user->hasRole('admin'));
  // }

  // /** @test*/
  // public function ok_is_returned_if_user_can_be_assigned_superadmin_role(){

  //   $user = User::where('username', 'test user')->first();

  //   $superadminRole = Role::findByName('superadmin');

  //   $user->assignRole($superadminRole);

  //   $this->assertTrue($user->hasRole('superadmin'));
  // }

  // //api/me/update
  // /** @test*/
  // public function ok_is_returned_if_user_can_update_his_profile(){

  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $token = $response->original['authorisation']['token'];

  //   $response = $this->patch('api/me/update', [
  //     'username' => 'test user updated',
  //     'email' => 'testuserupdated@example.com',
  //     'password' => '12345678',
  //     'phone' => '678678678',
  //     'token' => $token
  //   ]);

  //   $response->assertStatus(200);

  // }

  // //api/me/delete
  // /** @test*/
  // public function ok_is_returned_if_user_can_delete_his_profile(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $token = $response->original['authorisation']['token'];

  //   $response = $this->delete('api/me/delete', [
  //     'token' => $token
  //   ]);

  //   $response->assertStatus(200);
  // }

  // //api/user/delete/{id}
  // /** @test*/
  // public function ok_is_returned_if_user_superadmin_can_delete_user_admin_profile(){
  //   $response = $this->post('api/login', [
  //     'email' => 'usersuperadmin@example.com',
  //     'password' => '12345678'
  //   ]);

  //   // Verifica que el código de respuesta HTTP sea 200
  //   $response->assertStatus(200);

  //   $token = $response->original['authorisation']['token'];
  //   $userToDelete = User::where('username', 'admin')->first();
  //   $userIdToDelete = $userToDelete->id;

  //   // Crea una nueva petición POST a la ruta de eliminación de usuario utilizando el token de acceso

  //   $response = $this->delete('api/user/delete/' . $userIdToDelete, [
  //     'Bearer' => $token,
  //   ]);

  //   // Verifica que el código de respuesta HTTP sea 200
  //   $response->assertStatus(200);

  //   // Verifica que el usuario haya sido eliminado de la base de datos
  //   $this->assertDatabaseMissing('users', [
  //       'id' => $userIdToDelete,
  //   ]);
  // }

  // //api/me/delete
  /** @test*/
  public function ok_is_returned_if_user_superadmin_can_delete_his_profile(){
    $response = $this->post('api/login', [
      'email' => 'usersuperadmin@example.com',
      'password' => '12345678'
    ]);

    // $token = $response->original['authorisation']['token'];

    $response = $this->delete('api/me/delete', [
      // 'token' => $token
    ]);

    $response->assertStatus(200);
  }

  //api/user/update/{id}
  /** @test*/
  public function ok_is_returned_if_user_superadmin_can_update_user_role(){
    $response = $this->post('api/login', [
      'email' => 'usersuperadmin@example.com',
      'password' => '12345678'
    ]);

    $response->assertStatus(200);

    // $token = $response->original['authorisation']['token'];
    $userToUpgrade = User::where('email', 'testuser@example.com')->first();
    $userToUpgradeId = $userToUpgrade->id;

    $response = $this->patch('api/user/update/' . $userToUpgradeId, [
      // 'Bearer' => $token,
      'role' => "admin"
    ]);

    $response->assertStatus(200);

    $response = $this->post('api/login', [
      'email' => 'testuser@example.com',
      'password' => '12345678'
    ]);

    $token = $response->original['authorisation']['token'];

    $response = $this->post('api/me', [
      'token' => $token,
    ]);
  }
}
