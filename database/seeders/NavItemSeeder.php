<?php

namespace Database\Seeders;

use App\Models\NavItem;
use Illuminate\Database\Seeder;

class NavItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['sort_order' => 1, 'href' => '/', 'label' => ['fr' => 'Accueil', 'en' => 'Home', 'ar' => 'الرئيسية']],
            ['sort_order' => 2, 'href' => '/about', 'label' => ['fr' => 'A propos', 'en' => 'About', 'ar' => 'من نحن']],
            ['sort_order' => 3, 'href' => '/projects', 'label' => ['fr' => 'Projets', 'en' => 'Projects', 'ar' => 'المشاريع']],
            ['sort_order' => 4, 'href' => '/journal', 'label' => ['fr' => 'Actualites', 'en' => 'Journal', 'ar' => 'الأخبار']],
            ['sort_order' => 5, 'href' => '/gallery', 'label' => ['fr' => 'Galerie', 'en' => 'Gallery', 'ar' => 'المعرض']],
            ['sort_order' => 6, 'href' => '/contact', 'label' => ['fr' => 'Contact', 'en' => 'Contact', 'ar' => 'اتصل بنا']],
        ];

        foreach ($items as $item) {
            NavItem::create($item);
        }
    }
}
