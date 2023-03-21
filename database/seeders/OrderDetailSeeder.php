<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      OrderDetail::factory()->create([
        "order_id" => 1,
        "entrepreneurship_id" => 1,
        "quantity"=> 1
      ]);

      OrderDetail::factory()->create([
        "order_id" => 1,
        "entrepreneurship_id" => 2,
        "quantity"=> 2
      ]);

      OrderDetail::factory()->create([
        "order_id" => 1,
        "entrepreneurship_id" => 3,
        "quantity"=> 3
      ]);

      OrderDetail::factory()->create([
        "order_id" => 2,
        "entrepreneurship_id" => 1,
        "quantity"=> 1
      ]);

      OrderDetail::factory()->create([
        "order_id" => 2,
        "entrepreneurship_id" => 4,
        "quantity"=> 4
      ]);

      OrderDetail::factory()->create([
        "order_id" => 2,
        "entrepreneurship_id" => 3,
        "quantity"=> 2
      ]);

      OrderDetail::factory()->create([
        "order_id" => 3,
        "entrepreneurship_id" => 5,
        "quantity"=> 1
      ]);

      OrderDetail::factory()->create([
        "order_id" => 3,
        "entrepreneurship_id" => 2,
        "quantity"=> 1
      ]);

      OrderDetail::factory()->create([
        "order_id" => 3,
        "entrepreneurship_id" => 1,
        "quantity"=> 3
      ]);

      \App\Models\OrderDetail::factory(10)->create();
    }
}
