<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Signal;

class SignalSeeder extends Seeder
{
    public function run(): void
    {
        Signal::factory()->count(20)->create();
    }
}
