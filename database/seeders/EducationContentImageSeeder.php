<?php

namespace Database\Seeders;

use App\Models\EducationItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationContentImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $images = [
            // ---- Content 1: Toán học ----
            [
                'education_content_id' => 1,
                'image' => 'uploads/education/math1.jpg',
                'overlay_text' => 'Đếm số cùng bé',
                'sort_order' => 1,
            ],
            [
                'education_content_id' => 1,
                'image' => 'uploads/education/math2.jpg',
                'overlay_text' => 'Hình khối vui nhộn',
                'sort_order' => 2,
            ],

            // ---- Content 2: Ngôn ngữ ----
            [
                'education_content_id' => 2,
                'image' => 'uploads/education/language1.jpg',
                'overlay_text' => 'Làm quen chữ cái',
                'sort_order' => 1,
            ],
            [
                'education_content_id' => 2,
                'image' => 'uploads/education/language2.jpg',
                'overlay_text' => 'Kể chuyện sáng tạo',
                'sort_order' => 2,
            ],

            // ---- Content 3: Nghệ thuật ----
            [
                'education_content_id' => 3,
                'image' => 'uploads/education/art1.jpg',
                'overlay_text' => 'Tô màu sáng tạo',
                'sort_order' => 1,
            ],
            [
                'education_content_id' => 3,
                'image' => 'uploads/education/art2.jpg',
                'overlay_text' => 'Âm nhạc và nhảy múa',
                'sort_order' => 2,
            ],
        ];

        foreach ($images as $data) {
            EducationItem::create($data);
        }
    }
}
