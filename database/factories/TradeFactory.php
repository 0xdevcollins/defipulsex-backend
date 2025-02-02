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
            'user_id' => User::first()->id,
            'plan_id' => Plan::inRandomOrder()->first()->id,
            'transaction_id' => optional(Transaction::inRandomOrder()->first())->id,
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'state' => $this->faker->randomElement(['pending', 'active', 'completed', 'failed']),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'notes' => $this->faker->sentence,
        ];
    }
}
