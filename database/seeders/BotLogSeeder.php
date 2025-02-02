<?php

namespace Database\Seeders;

use App\Models\BotLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BotLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BotLog::factory()->count(30)->create();
    }
}
