<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'api',
            'permissions' => ['*'],
        ]);

        Role::create([
            'name' => 'editor',
            'guard_name' => 'api',
            'permissions' => [
                'projects.*', 'posts.*', 'pages.*',
                'gallery.*', 'media.upload',
            ],
        ]);

        Role::create([
            'name' => 'viewer',
            'guard_name' => 'api',
            'permissions' => [
                'projects.read', 'posts.read', 'pages.read',
                'gallery.read',
            ],
        ]);
    }
}
