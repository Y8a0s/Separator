<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'brand' => fake()->word(),
            'build_model' => fake()->numberBetween(1000 , 9999),
            'description' => fake()->text(),
            'available' => fake()->boolean()
        ];
    }
}
