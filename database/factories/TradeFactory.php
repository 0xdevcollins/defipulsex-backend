<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trade>
 */
class TradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'plan_id' => Plan::factory(),
            'transaction_id' => Transaction::factory()->nullable(),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'state' => $this->faker->randomElement(['pending', 'active', 'completed', 'failed']),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'notes' => $this->faker->sentence,
        ];
    }
}
