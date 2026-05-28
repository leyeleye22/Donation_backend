<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'file_path' => '/assets/education.jpeg',
                'file_type' => 'image',
                'categories' => ['photos', 'education'],
                'title' => ['fr' => 'Programme education', 'en' => 'Education program', 'ar' => 'برنامج التعليم'],
            ],
            [
                'file_path' => '/assets/consultation.jpeg',
                'file_type' => 'image',
                'categories' => ['photos', 'sante'],
                'title' => ['fr' => 'Consultation sante', 'en' => 'Health consultation', 'ar' => 'استشارة صحية'],
            ],
            [
                'file_path' => '/assets/puits.jpeg',
                'file_type' => 'image',
                'categories' => ['photos', 'eau'],
                'title' => ['fr' => 'Acces a l eau', 'en' => 'Water access', 'ar' => 'الوصول إلى المياه'],
            ],
        ];

        foreach ($items as $data) {
            GalleryItem::create($data);
        }
    }
}
