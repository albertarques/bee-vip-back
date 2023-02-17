<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::all()->random();
        return [
            'user_id' => $user->id,
            'card_name' => fake()->name(),
            'card_number' => fake()->creditCardNumber(),
            'expire_date'=> fake()->creditCardExpirationDateString(),
            'type' => fake()->creditCardType(),
        ];
    }
}
