<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $roles = ['Super-admin'];

        foreach ($roles as $role) {
            \Spatie\Permission\Models\Role::updateOrCreate(
                ['name' => $role],
                ["name" => $role, "guard_name" => "web"]
            );
        }
    }
}
