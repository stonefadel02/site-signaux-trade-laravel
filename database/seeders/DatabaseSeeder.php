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
        // User::factory(10)->create();
        $this->call(SessionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PlanSeeder::class);
        $admin = User::updateOrCreate([
            "email" => "admin@admin.com",
        ], [
            "name" => "Administrateur",
            "email_verified_at" => now(),
            "password" => bcrypt("password")
        ]);
        $admin->assignRole('Super-admin');

    }
}
