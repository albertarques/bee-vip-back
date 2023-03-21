<?php

// namespace Tests\Feature;

// use Tests\TestCase;
// use App\Models\OrderDetail;
// use Illuminate\Support\Facades\Artisan;


// class OrderTest extends TestCase
// {

//     public function setUp(): void
//     {
//         parent::setUp();
//         Artisan::call('migrate:fresh --seed --env=testing');

//         $this->post('api/register', [
//             'username' => 'test user',
//             'email' => 'testuser@example.com',
//             'password' => '12345678',
//             'phone' => '000111222'
//         ]);

//         $this->post('api/order/create', [
//             'customer_id' => 15,
//         ]);
//         $this->post('api/orderdetail/create', [
//             'id' => 11,
//             'entrepreneurship_id' => 33,
//             'quantity' => 3,
//         ]);
//     }
//       /** @test*/
//     //   api/order/create
//       public function ok_is_returned_if_user_user_can_create_order(){
//         $response = $this->post('api/login', [
//                 'email' => 'testuser@example.com',
//                 'password' => '12345678'
//               ]);

//         $response->assertStatus(200);
//         $token = $response->original['authorisation']['token'];

//           $response = $this->post('api/order/create', [
//             'token' => $token
//           ]);

//           $response->assertStatus(200);
//       }
//       /** @test*/
//     //   api/orders_my
//       public function ok_is_returned_if_user_user_can_view_order_index(){
//         $response = $this->post('api/login', [
//                 'email' => 'testuser@example.com',
//                 'password' => '12345678'
//               ]);

//         $response->assertStatus(200);
//         $token = $response->original['authorisation']['token'];

//           $response = $this->get('api/orders_my', [
//             'token' => $token
//           ]);

//           $response->assertStatus(200);
//       }
//        /** @test*/
//     //    api/order/{id}
//        public function ok_is_returned_if_user_user_can_view_an_order(){
//         $response = $this->post('api/login', [
//                 'email' => 'testuser@example.com',
//                 'password' => '12345678'
//               ]);
//         $response->assertStatus(200);

//           $response = $this->get('api/order/11');

//           $response->assertStatus(200);

//       }
//     /** @test*/
//     //    api/orderdetail/create
//     public function ok_is_returned_if_user_user_can_view_an_order_detail()
//     {
//         $response = $this->post('api/login', [
//             'email' => 'testuser@example.com',
//             'password' => '12345678'
//         ]);
//         $response->assertStatus(200);

//         $orderDetailView = OrderDetail::factory()->create();
        
//         $token = $response->original['authorisation']['token'];

//         $response = $this->post('api/orderdetail/create', [
//             'token'=> $token,
//             'order_id' => $orderDetailView->order_id,
//             'entrepreneurship_id' => $orderDetailView->entrepreneurship_id,
//             'quantity' => $orderDetailView->quantity,
           
//         ]);
//         $response->assertStatus(200);
//     }
// }
