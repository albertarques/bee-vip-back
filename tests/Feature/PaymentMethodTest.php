<?php

namespace Tests\Feature;

use App\Models\PaymentMethod;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class PaymentMethodTest extends TestCase
{

  // public function setUp(): void {
  //   parent::setUp();
  //   Artisan::call('migrate:fresh --seed --env=testing');

  //   // ID 15
  //   $this->post('api/register', [
  //     'username' => 'test user',
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678',
  //     'phone' => '000111222'
  //   ]);

  //   // ID 11
  //   $this->post('api/paymentmethod/create', [
  //     "card_name" => "test user",
  //     "card_number" => "666666666666",
  //     "expire_date" => "07/24",
  //     "type" => "VISA"
  //   ]);
  // }

  // /** @test */
  // // api/paymentmethod/create
  // public function ok_is_returned_if_user_creates_payment_method(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $response->assertStatus(200);

  //   $response = $this->post('api/paymentmethod/create', [
  //     "card_name" => "Albert Arques",
  //     "card_number" => "666666666666",
  //     "expire_date" => "07/24",
  //     "type" => "VISA"
  //   ]);

  //   $response->assertStatus(200);
  // }

  // /** @test */
  // //api/paymentmethods
  // public function ok_is_returned_if_user_view_list_of_his_payment_methods(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $response->assertStatus(200);

  //   $response = $this->get('api/paymentmethods');

  //   $response->assertStatus(200);
  // }

  // /** @test */
  // //api/paymentmethod/delete/{id}
  // public function ok_is_returned_if_user_delete_his_single_payment_method(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $response->assertStatus(200);

  //   $paymentMethodToDelete = PaymentMethod::where('card_name', 'test user')->first();

  //   $response = $this->delete('api/paymentmethod/delete/11');
  //   $response->assertStatus(200);
  // }

  // /** @test */
  // // api/paymentmethod/show/{id}
  // public function ok_is_returned_if_user_show_a_single_payment_method(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);

  //   $response->assertStatus(200);
  //   $paymentMethodToShow = PaymentMethod::where('card_name', 'test user')->first();

  //   $response = $this->get('api/paymentmethod/show/11');

  //   $response->assertStatus(200);
  // }

  // /** @test */
  // //paymentmethod/update/{id}
  // public function ok_is_returned_if_user_can_update_payment_method(){
  //   $response = $this->post('api/login', [
  //     'email' => 'testuser@example.com',
  //     'password' => '12345678'
  //   ]);
  //   $response->assertStatus(200);

  //   $response = $this->patch('api/paymentmethod/update/11', [
  //     "card_name" => "Alejo Buritica",
  //     "card_number" => "666666666666",
  //     "expire_date" => "07/24",
  //     "type" => "VISA"
  //   ]);
  //   $response->assertStatus(200);
  // }
}
