<?php

namespace Database\Factories;

use App\Models\AvailabilityState;
use App\Models\Category;
use App\Models\InspectionState;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EntrepreneurshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = Category::all()->random();
        $user = User::all()->random();
        $availability = AvailabilityState::all()->random();
        $inspection = InspectionState::all()->random();
        return [
            'user_id' => $user->id,
            'title'=> fake()->text($maxNbChars = 100),
            'logo'=> fake()->image($dir = null, $width = 173, $height= 80),
            'product_img'=> fake()->image($dir = null, $width = 390, $height= 203),
            'description'=> fake()->text($maxNbChars = 300),
            'price' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0.50, $max = 1000),
            'category_id' => $category->id,
            'avg_score'=> fake()->numberBetween($int1 = 0, $int2 = 5),
            'cash_payment' => fake()->boolean(),
            'card_payment' => fake()->boolean(),
            'bizum_payment' => fake()->boolean(),
            'stock'=> fake()->numberBetween($int1 = 0, $int2 = 50),
            'availability_state'=> $availability -> id,
            'phone_number' => fake()->phoneNumber(),
            'email'=> fake()->email(),
            'location' => fake()->city(),
            'inspection_state' => $inspection -> id,
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
