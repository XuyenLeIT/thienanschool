<?php

namespace Database\Seeders;

use App\Models\GalleryImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryImages = [
            // Gallery 1
            [
                'gallery_id' => 1,
                'image_path' => 'uploads/gallery/study1.jpg',
            ],
            [
                'gallery_id' => 1,
                'image_path' => 'uploads/gallery/study2.jpg',
            ],

            // Gallery 2
            [
                'gallery_id' => 2,
                'image_path' => 'uploads/gallery/fun1.jpg',
            ],
            [
                'gallery_id' => 2,
                'image_path' => 'uploads/gallery/fun2.jpg',
            ],

            // Gallery 3
            [
                'gallery_id' => 3,
                'image_path' => 'uploads/gallery/sport1.jpg',
            ],
            [
                'gallery_id' => 3,
                'image_path' => 'uploads/gallery/sport2.jpg',
            ],
        ];

        foreach ($galleryImages as $data) {
            GalleryImages::create($data);
        }
    }
}
