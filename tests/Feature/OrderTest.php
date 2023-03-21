<?php

namespace Tests\Feature;

use App\Models\Order;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;


class OrderTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed --env=testing');

    }
    /** @test*/
    //   api/order/create
    public function ok_is_returned_if_user_user_can_create_order()
    {
        // Crear un usuario utilizando el Factory
        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user);

        // Crear una orden utilizando el Factory
        $order = Order::factory()->create([
            'customer_id' => $user->id,
        ]);
        $response = $this->post('api/order/create', [
            'customer_id' => $order->customer_id,
        ]);

        $response->assertStatus(200);
    }
    /** @test*/
    //   api/orders_my
    public function ok_is_returned_if_user_user_can_view_order_index()
    {
        // Crear un usuario utilizando el Factory
        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user);

        // Crear una orden utilizando el Factory
        Order::factory(5)->create([
            'customer_id' => $user->id,
        ]);

        $response = $this->get('api/orders_my');
        $response->assertStatus(200);
        $response = $response->json();
        $this->assertIsArray($response);
        $ordersArray = $response['orders'];
        $this->assertCount(5, $ordersArray);
    }
    /** @test*/
    //    api/order/{id}
    public function ok_is_returned_if_user_user_can_view_an_order()
    {

        // Crear un usuario utilizando el Factory
        $user = User::factory()->create();
        $user->assignRole('user');

        $this->actingAs($user);

        // Crear una orden utilizando el Factory
        $order = Order::factory()->create([
            'customer_id' => $user->id,
        ]);

        $response = $this->get('api/order/' . $order->id);
        $response->assertStatus(200);
    }
    /** @test*/
    //    api/orderdetail/create
    public function ok_is_returned_if_user_user_can_create_an_order_detail()
    {
        // Crear un usuario utilizando el Factory
        $user = User::factory()->create();
        $user->assignRole('user');
        
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $order = Order::factory()->create([
            'customer_id' => $user->id,
        ]);

        $response = $this->post('api/orderdetail/create', [
            "order_id" => $order->id,
            "entrepreneurship_id" => 33,
            "quantity" => 3
        ]);
        $response->assertStatus(200);
    }
}
