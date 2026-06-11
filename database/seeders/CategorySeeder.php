<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $themes = [
            ['slug' => 'water', 'name' => ['fr' => 'Forage / eau', 'en' => 'Water', 'ar' => '']],
            ['slug' => 'education', 'name' => ['fr' => 'Education', 'en' => 'Education', 'ar' => '']],
            ['slug' => 'health', 'name' => ['fr' => 'Sante', 'en' => 'Health', 'ar' => '']],
            ['slug' => 'tabaski', 'name' => ['fr' => 'Tabaski', 'en' => 'Tabaski', 'ar' => '']],
            ['slug' => 'food', 'name' => ['fr' => 'Alimentation', 'en' => 'Food', 'ar' => '']],
        ];

        foreach ($themes as $theme) {
            Category::firstOrCreate(
                ['slug' => $theme['slug'], 'type' => 'project'],
                ['name' => $theme['name']]
            );
        }
    }
}
