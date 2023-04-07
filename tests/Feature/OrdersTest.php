<?php

namespace Tests\Feature;

use App\Models\User;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class OrdersTest extends TestCase
{
  public function setUp(): void {
    parent::setUp();
    Artisan::call('migrate:fresh --seed --env=testing');
  }

  /** @test */
  // order/create
  public function ok_is_returned_if_user_create_an_order() {
    // Crear un usuario admin utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario admin
    $this->actingAs($user);

    // Crear una orden
    $response = $this->post('api/order/create');
    $order_id = $response->json('order')['id'];
    $response->assertStatus(200);

    // Verificar que el emprendimiento fue creado exitosamente
    $this->assertDatabaseHas('orders', [
        'id' => $order_id,
        'customer_id' => $user->id,
    ]);
  }

  /** @test */
  // orders_my
  public function ok_is_returned_if_user_views_a_list_of_his_orders() {
    // Crear un usuario admin utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario admin
    $this->actingAs($user);

    // Crear una orden
    $response = $this->post('api/order/create');
    $order_id = $response->json('order')['id'];

    $response->assertStatus(200);

    // Verificar que el emprendimiento fue creado exitosamente
    $this->assertDatabaseHas('orders', [
        'id' => $order_id,
        'customer_id' => $user->id,
    ]);

    // Verificar que el usuario puede ver la lista de sus ordenes
    $response = $this->get('api/orders_my');
    $response->assertStatus(200);
  }


  /** @test */
  // order/{id}
  public function ok_is_returned_if_user_show_a_single_order(){
    // Crear un usuario admin utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario admin
    $this->actingAs($user);

    // Crear una orden
    $response = $this->post('api/order/create');
    $order_id = $response->json('order')['id'];

    $response->assertStatus(200);

    // Verificar que el emprendimiento fue creado exitosamente
    $this->assertDatabaseHas('orders', [
        'id' => $order_id,
        'customer_id' => $user->id,
    ]);

    // Verificar que el usuario puede ver la lista de sus ordenes
    $response = $this->get('api/order/'.$order_id);
    $response->assertStatus(200);
  }

}
