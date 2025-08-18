<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            Role::updateOrCreate(
                ['name' => $role],
                ["name" => $role, "guard_name" => "web"]
            );
        }
    }
}
