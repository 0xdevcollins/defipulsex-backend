<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => '0x' . Str::random(40),  // Simulating an Ethereum-like address
            'private_key' => '0x' . Str::random(64),  // Simulating a private key
            'seed_phrase' => implode(' ', $this->faker->words(12)),  // A 12-word seed phrase
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
