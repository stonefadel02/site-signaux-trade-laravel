<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccessCode;
use App\Models\Plan; 
use Illuminate\Support\Str;

class AccessCodeSeeder extends Seeder
{
    public function run(): void
    {
        $plan = Plan::first();
        if (!$plan) {
            $plan = Plan::factory()->create(['nom' => 'Plan Essentiel', 'prix' => 15]);
        }

        AccessCode::create([
            'plan_id' => $plan->id,
            'Code' => 'T10-'.strtoupper(Str::random(6)),
            'DureeEnJours' => 30,
            'ExpireLe' => now()->addDays(30),
        ]);

        AccessCode::create([
            'plan_id' => $plan->id,
            'Code' => 'T10-'.strtoupper(Str::random(6)),
            'DureeEnJours' => 7,
            'ExpireLe' => now()->addDays(7),
        ]);
    }
}