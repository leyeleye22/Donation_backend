<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('name', 'admin')->first();

        User::create([
            'name' => 'Admin Entraide',
            'email' => 'admin@entraide-humanitaire.org',
            'password' => bcrypt('Admin2026!'),
            'role' => 'admin',
            'role_id' => $adminRole?->id,
            'is_active' => true,
        ]);
    }
}
