<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Hoạt động học tập',
                'description' => 'Các hoạt động học tập nổi bật của bé.'
            ],
            [
                'title' => 'Hoạt động vui chơi',
                'description' => 'Khoảnh khắc vui tươi trong sân trường.'
            ],
            [
                'title' => 'Ngày hội thể thao',
                'description' => 'Những hình ảnh từ sự kiện thể thao của trường.'
            ],
        ];

        foreach ($galleries as $data) {
            Gallery::create($data);
        }
    }
}
