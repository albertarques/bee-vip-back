<?php

namespace Database\Factories;

use App\Models\Entrepreneurship;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $entrepreneurship = Entrepreneurship::all()->random();
        $user = User::all()->random();

        return [
            'entrepreneurship_id' => $entrepreneurship->id,
            'user_id' => $user->id,
            'score' => fake()->numberBetween($int1 = 0, $int2 = 5),
            'comment' => fake()->realText($maxNbChars= 300),
            // 'created_at',
            // 'updated_at',
        ];
    }
}
