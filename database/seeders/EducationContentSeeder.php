<?php

namespace Database\Seeders;

use App\Models\EducationContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            [
                'title' => 'Khám phá Toán học',
                'main_image' => 'uploads/education/math_main.jpg',
                'caption' => 'Cùng bé làm quen các con số',
                'description' => 'Giúp trẻ nhận biết số đếm, hình khối và phát triển tư duy logic.',
            ],
            [
                'title' => 'Khám phá Ngôn ngữ',
                'main_image' => 'uploads/education/language_main.jpg',
                'caption' => 'Bé học chữ cái và ngôn ngữ',
                'description' => 'Học chữ cái, phát triển khả năng đọc, nghe, kể chuyện và giao tiếp.',
            ],
            [
                'title' => 'Khám phá Nghệ thuật',
                'main_image' => 'uploads/education/art_main.jpg',
                'caption' => 'Tô màu, vẽ tranh, ca hát',
                'description' => 'Khơi gợi sự sáng tạo, thẩm mỹ và cảm thụ nghệ thuật cho trẻ.',
            ],
        ];

        foreach ($contents as $data) {
            EducationContent::create($data);
        }
    }
}
