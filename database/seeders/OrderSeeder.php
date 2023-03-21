<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Order::factory()->create([
        'customer_id' => 1,
        'id' => 1,
      ]);

      Order::factory()->create([
        'customer_id' => 2,
        'id' => 2,
      ]);

      Order::factory()->create([
        'customer_id' => 3,
        'id' => 3,
      ]);

      Order::factory()->create([
        'customer_id' => 4,
        'id' => 4,
      ]);

      Order::factory()->create([
        'customer_id' => 5,
        'id' => 5,
      ]);

      \App\Models\Order::factory(10)->create();
    }
}
