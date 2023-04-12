<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class CategoriesTest extends TestCase
{
  public function setUp(): void {
    parent::setUp();
    Artisan::call('migrate:fresh --seed --env=testing');
  }

  /** @test */
  // category/create
  public function ok_is_returned_if_superadmin_create_category(){
    // Crear un usuario admin utilizando el Factory
    $superadmin = User::factory()->create();
    $superadmin->assignRole('superadmin');

    // Loguearse con el usuario admin
    $this->actingAs($superadmin);

    // Crear una categoría utilizando el Factory
    // $category = Category::factory()->create([
    //     'name' => 'test category',
    // ]);

    $response = $this->post('api/category/create', [
      'name' => 'test category',
    ]);
    $response->assertStatus(200);

    // Verificar que la categoría fue creada exitosamente
    $this->assertDatabaseHas('categories', [
        'name' => 'test category',
    ]);
  }

  /** @test */
  // category/create
  public function ko_is_returned_if_user_creates_category(){
    // Crear un usuario user utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario user
    $this->actingAs($user);

    $response = $this->post('api/category/create', [
      'name' => 'test category',
    ]);
    $response->assertStatus(403);

    // Verificar que la categoría no fue creada
    $this->assertDatabaseMissing('categories', [
        'name' => 'test category',
    ]);
  }

  /** @test */
  // category/create
  public function ko_is_returned_if_admin_creates_category(){
    // Crear un usuario admin utilizando el Factory
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    // Loguearse con el usuario admin
    $this->actingAs($admin);

    $response = $this->post('api/category/create', [
      'name' => 'test category',
    ]);
    $response->assertStatus(403);

    // Verificar que la categoría no fue creada
    $this->assertDatabaseMissing('categories', [
        'name' => 'test category',
    ]);
  }

  /** @test */
  // category/update/{id}
  public function ok_is_returned_if_superadmin_update_category(){
    // Crear un usuario admin utilizando el Factory
    $superadmin = User::factory()->create();
    $superadmin->assignRole('superadmin');

    $token = $superadmin->createToken('Test Token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    // Loguearse con el usuario admin
    $this->actingAs($superadmin);

    // Crear una categoría utilizando el Factory
    $category = Category::factory()->create([
        'name' => 'test category',
    ]);

    // Actualizar la categoría
    $response = $this->patch('api/category/update/' . $category->id, [
      'name' => 'test category updated',
    ], $headers);

    $response->assertStatus(200);

    // Verificar que la categoría fue actualizada exitosamente
    $this->assertDatabaseHas('categories', [
        'name' => 'test category updated',
    ]);
  }

  /** @test */
  // category/update/{id}
  public function ko_is_returned_if_user_updates_categroy(){
    // Crear un usuario user utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario user
    $this->actingAs($user);

    // Crear una categoría utilizando el Factory
    $category = Category::factory()->create([
        'name' => 'test category',
    ]);

    // Actualizar la categoría
    $response = $this->patch('api/category/update/' . $category->id, [
      'name' => 'test category updated',
    ]);

    $response->assertStatus(403);

    // Verificar que la categoría no fue actualizada
    $this->assertDatabaseMissing('categories', [
        'name' => 'test category updated',
    ]);
  }

  /** @test */
  // category/delete/{id}
  public function ok_is_returned_if_superadmin_delete_category(){
    // Crear un usuario admin utilizando el Factory
    $superadmin = User::factory()->create();
    $superadmin->assignRole('superadmin');

    // Loguearse con el usuario admin
    $this->actingAs($superadmin);

    // Crear una categoría utilizando el Factory
    $category = Category::factory()->create([
        'name' => 'test category',
    ]);

    $response = $this->delete('api/category/delete/' . $category->id);

    $response->assertStatus(200);

    // Verificar que la categoría fue eliminada exitosamente
    $this->assertDatabaseMissing('categories', [
        'name' => 'test category',
    ]);
  }

  /** @test */
  // category/delete/{id}
  public function ko_is_returned_if_admin_delete_category(){
    // Crear un usuario admin utilizando el Factory
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    // Loguearse con el usuario admin
    $this->actingAs($admin);

    // Crear una categoría utilizando el Factory
    $category = Category::factory()->create([
        'name' => 'test category',
    ]);

    $response = $this->delete('api/category/delete/' . $category->id);

    $response->assertStatus(403);

    // Verificar que la categoría no fue eliminada
    $this->assertDatabaseHas('categories', [
        'name' => 'test category',
    ]);
  }

  /** @test */
  // category/delete/{id}
  public function ko_is_returned_if_user_delete_category(){
    // Crear un usuario user utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario user
    $this->actingAs($user);

    // Crear una categoría utilizando el Factory
    $category = Category::factory()->create([
        'name' => 'test category',
    ]);

    $response = $this->delete('api/category/delete/' . $category->id);

    $response->assertStatus(403);

    // Verificar que la categoría no fue eliminada
    $this->assertDatabaseHas('categories', [
        'name' => 'test category',
    ]);
  }
}
