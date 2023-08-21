<?php

namespace Tests\Feature;

use App\Models\Entrepreneurship;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class EntrepreneurshipTest extends TestCase
{
  public function setUp(): void {
    parent::setUp();
    Artisan::call('migrate:fresh --seed --env=testing');
  }

  /** @test */
  // api/entrepreneurship/create
  public function ko_is_returned_if_user_create_entrepreneurship(){
    // Crear un usuario admin utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario admin
    $this->actingAs($user);

    // Crear un emprendimiento utilizando el Factory y observar la respuesta del servidor
    $entrepreneurship = Entrepreneurship::factory()->create([
        'user_id' => $user->id,
    ]);


    // Verificar que la respuesta del servidor es un codigo 403
    $response = $this->post('api/entrepreneurship/create');
    $response->assertStatus(403);

  }

  /** @test */
  // api/entrepreneurship/create
  public function ok_is_returned_if_admin_create_entrepreneurship(){
    // Crear un usuario admin utilizando el Factory
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    // Loguearse con el usuario admin
    $this->actingAs($admin);

    // Crear un emprendimiento utilizando el Factory
    $emprendimiento = Entrepreneurship::factory()->create([
        'user_id' => $admin->id,
    ]);

    // Verificar que el emprendimiento fue creado exitosamente
    $this->assertDatabaseHas('entrepreneurships', [
        'id' => $emprendimiento->id,
        'title' => $emprendimiento->title,
        'user_id' => $admin->id,
    ]);
  }

  /** @test */
  // api/entrepreneurship/delete_my/{id}
  public function ok_is_returned_if_admin_can_delete_his_entrepreneurship(){
    // Crear un usuario admin utilizando el Factory
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    // Loguearse con el usuario admin
    $this->actingAs($admin);

    // Crear un emprendimiento utilizando el Factory
    $entrepreneurship = Entrepreneurship::factory()->create([
      'user_id' => $admin->id,
    ]);

    $response = $this->delete('api/entrepreneurship/delete_my/' . $entrepreneurship->id);

    $response->assertStatus(200);

  }

  /** @test */
  // api/entrepreneurship/update_my/{id}
  public function ok_is_returned_if_admin_can_update_his_entrepreneurship(){
    // Crear un usuario admin utilizando el Factory
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    // Loguearse con el usuario admin
    $this->actingAs($admin);

    // Crear un emprendimiento utilizando el Factory
    $entrepreneurship = Entrepreneurship::factory()->create([
      'user_id' => $admin->id,
    ]);

    $response = $this->patch('api/entrepreneurship/update_my/' . $entrepreneurship->id, [
      'title' => 'Nuevo titulo',
      'logo' => '',
      'product_img' => '',
      'description' => 'Nueva descripcion',
      'user_id' => $admin->id,
      'price' => 100,
      'category_id' => 1,
      'cash_payment' => 1,
      'card_payment' => 1,
      'bizum_payment' => 1,
      'stock' => 25,
      'phone' => '666666666',
      'email' => 'entrepreneurshipTest@example.com',
      'location' => 'Calle falsa 123',
      'availability_state' => 1,
    ]);

    $response->assertStatus(200);

  }

  /** @test */
  // api/entrepreneurships/view_my
  public function ok_is_returned_if_admin_view_a_list_of_his_entrepreneurships(){
    // Crear un usuario admin utilizando el Factory
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    // Loguearse con el usuario admin
    $this->actingAs($admin);

    // Crear un emprendimiento utilizando el Factory
    $entrepreneurships = Entrepreneurship::factory(5)->create([
      'user_id' => $admin->id,
    ]);

    // Verificar que devuelve la lista de emprendimientos del usuario
    $response = $this->get('api/entrepreneurships/view_my');
    $response->assertStatus(200);
    $response = $response->json();

    $this->assertIsArray($response);

    $entrepreneurshipArray = $response['entrepreneurships'];
    $this->assertCount(5, $entrepreneurshipArray);
  }

  /** @test */
  // api/entrepreneurship/delete/{id}
  public function ok_is_returned_if_superadmin_can_delete_entrepreneurship(){

    // Crear un usuario superadmin utilizando el Factory
    $superadmin = User::factory()->create();
    $superadmin->assignRole('superadmin');

    $token = $superadmin->createToken('Test Token')->accessToken;
    $headers = ['Authorization' => "Bearer $token"];

    // Loguearse con el usuario superadmin
    $this->actingAs($superadmin);
    $this->assertAuthenticatedAs($superadmin);

    // Crear un emprendimiento utilizando el Factory
    $entrepreneurship = Entrepreneurship::factory()->create([
      'user_id' => $superadmin->id,
    ]);

    $this->assertDatabaseHas('entrepreneurships', [
      'id' => $entrepreneurship->id,
    ]);

    $deletedEntrepreneurship = $this->delete('api/entrepreneurship/delete/' . $entrepreneurship->id, $headers);
    $deletedEntrepreneurship->assertStatus(200);

    $this->assertDatabaseMissing('entrepreneurships', [
        'id' => $entrepreneurship->id,
    ]);
  }

  /** @test */
  // api/entrepreneurship/inspect/{id}
  public function ok_is_returned_if_superadmin_can_inspect_entreprenenurship(){
    // Crear un usuario admin utilizando el Factory
    $superadmin = User::factory()->create();
    $superadmin->assignRole('superadmin');

    // Loguearse con el usuario admin
    $this->actingAs($superadmin);

    // Crear un emprendimiento utilizando el Factory
    $entrepreneurship = Entrepreneurship::factory()->create();

    $response = $this->patch('api/entrepreneurship/inspect/' . $entrepreneurship->id, [
      'inspection_state' => 3
    ]);

    $response->assertStatus(200);
  }

  /** @test */
  // api/entrepreneurships/pending
  public function ok_is_returned_if_admin_can_view_pending_entrepreneurships(){
    // Crear un usuario admin utilizando el Factory
    $superadmin = User::factory()->create();
    $superadmin->assignRole('superadmin');

    // Loguearse con el usuario admin
    $this->actingAs($superadmin);

    // Crear un emprendimiento utilizando el Factory
    $entrepreneurship = Entrepreneurship::factory()->create([
      'inspection_state' => 1
    ]);

    $response = $this->get('api/entrepreneurships/pending');

    $response->assertStatus(200);
  }

}
