<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Entrepreneurship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $order = Order::all()->random();
        $entrepreneurship = Entrepreneurship::all()->random();

        return [
        'order_id' => $order->id,
        'entrepreneurship_id' => $entrepreneurship->id,
        'quantity'=> fake() -> numberBetween($int1 = 1, $int2 = 100),
        'paid'  => fake() -> boolean(),

        ];
    }
}
