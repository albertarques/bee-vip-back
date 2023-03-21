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
}
