<?php

namespace Database\Factories;


use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $provider = User::all()->random();
        $customer = User::all()->random();

        return [
        // 'provider_id' => $provider->id,
        'customer_id' => $customer->id,
        'created_at',
        'updated_at'
        ];
    }
}
