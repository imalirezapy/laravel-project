<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image' => $faker->text(20).".jpg",
            'name' => $faker->text(20),
            'price' => $faker->numberBetween(10000, 500000),
            'description' => $faker->paragraph(rand(5, 40)),

        ];
    }
}
