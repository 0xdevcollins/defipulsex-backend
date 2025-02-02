<?php

    namespace Database\Factories;

    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
     */
    class TransactionFactory extends Factory
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
                'type' => $this->faker->randomElement(['deposit', 'withdrawal', 'transfer', 'payment']),
                'amount' => $this->faker->randomFloat(2, 100, 10000),
                'status' => $this->faker->randomElement(['completed', 'pending', 'failed']),
                'date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            ];
        }
    }
