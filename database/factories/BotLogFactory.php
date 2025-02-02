<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BotLog>
 */
class BotLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actions = [
            'buy',
            'sell',
            'hold',
            'error',
            'trade_completed',
            'trade_failed',
            'order_placed',
            'order_cancelled'
        ];

        $messages = [
            'buy' => 'Successfully placed a buy order for 50 units at $3000.',
            'sell' => 'Sell order completed. Sold 50 units at $3500.',
            'hold' => 'No action taken. Waiting for market conditions to improve.',
            'error' => 'Error occurred while processing the trade. Timeout reached.',
            'trade_completed' => 'Trade completed successfully. Profit realized: $500.',
            'trade_failed' => 'Trade failed due to insufficient funds. Cancelling order.',
            'order_placed' => 'Order placed successfully for 100 units at $4000.',
            'order_cancelled' => 'Order cancelled due to market volatility. Retry later.'
        ];

        $action = $this->faker->randomElement($actions);
        $message = $messages[$action];

        return [
            'action' => $action,
            'message' => $message . ' ' . $this->faker->sentence(5),
        ];
    }
}
