<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class OrderDetailsTest extends TestCase
{
  public function setUp(): void {
    parent::setUp();
    Artisan::call('migrate:fresh --seed --env=testing');
  }

  /** @test */
  // orderdetail/create
  public function ok_is_returned_if_user_add_an_order_detail_to_an_order() {
    // Crear un usuario admin utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Loguearse con el usuario admin
    $this->actingAs($user);

    // Crear una orden a través del Factory
    $order = Order::factory()->create([
        'customer_id' => $user->id,
    ]);

    // Crear un detalle de orden
    $response = $this->post('api/orderdetail/create', [
      'order_id' => $order->id,
      'entrepreneurship_id' => 1,
      'quantity' => 1,
    ]);

    $response->assertStatus(200);

    // Verificar que el detalle de orden fue creado exitosamente
    $this->assertDatabaseHas('order_details', [
        'order_id' => $order->id,
        'entrepreneurship_id' => 1,
        'quantity' => 1,
    ]);
  }
}
