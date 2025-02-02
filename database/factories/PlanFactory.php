<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'min_amount' => $this->faker->numberBetween(100, 10000),
            'max_amount' => $this->faker->numberBetween(10000, 50000),
            'fixed_amount' => $this->faker->numberBetween(1000, 10000),
            'percent_return' => $this->faker->numberBetween(5, 30),
            'duration' => $this->faker->numberBetween(30, 365),
            'description' => $this->faker->sentence(10),
        ];
    }
}
