<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $password = env('ADMIN_PASSWORD');
        if (!$password) {
            if (app()->environment('production')) {
                throw new \RuntimeException('ADMIN_PASSWORD must be set before seeding in production.');
            }
            $password = 'Admin2026!';
            Log::warning('AdminUserSeeder: using default dev password. Set ADMIN_PASSWORD in production.');
        }
        $email = env('ADMIN_EMAIL', 'admin@entraide-humanitaire.org');

        if (User::where('email', $email)->exists()) {
            Log::info('AdminUserSeeder: admin user already exists, skipping.');
            return;
        }

        User::create([
            'name' => 'Admin Entraide',
            'email' => $email,
            'password' => bcrypt($password),
            'role' => 'admin',
            'role_id' => $adminRole?->id,
            'is_active' => true,
        ]);
    }
}
