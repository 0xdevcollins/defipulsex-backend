<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PlanSeeder::class,
            TradeSeeder::class,
            TransactionSeeder::class, // Assuming TransactionSeeder exists
            DepositSeeder::class,     // Assuming DepositSeeder exists
            WithdrawalSeeder::class,  // Assuming WithdrawalSeeder exists
            BotLogSeeder::class,       // Assuming BotLogSeeder exists
            WalletSeeder::class
        ]);

    }
}
