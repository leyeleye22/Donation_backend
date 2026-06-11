<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AdminUserSeeder::class,
            NavItemSeeder::class,
            CategorySeeder::class,
            ProjectSeeder::class,
            PostSeeder::class,
            GalleryItemSeeder::class,
            PageContentSeeder::class,
            GlobalSettingsSeeder::class,
        ]);
    }
}
