<?php

namespace Database\Factories;

use App\Models\Category;
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
        return [
        'user_id' => $user->id,
        'title'=> fake()->text($maxNbChars = 100),
        'logo'=> fake()->image($dir = null, $width = 173, $height= 80),
        'image'=> fake()->image($dir = null, $width = 390, $height= 203),
        'description'=> fake()->text($maxNbChars = 300),
        'category_id' => $category->id,
        'phone'=> fake()->phoneNumber(),
        'email'=> fake()->email(),
        'avg_score'=> fake()->numberBetween($int1 = 0, $int2 = 5),
        'payment_1' => fake()->boolean(),
        'payment_2' => fake()->boolean(),
        'payment_3' => fake()->boolean(),
        'stock'=> fake()->numberBetween($int1 = 0, $int2 = 50),
        'availability'=> fake()->boolean($chanceOfGettingTrue = 1),
        // 'created_at',
        // 'updated_at',
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
