<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::insert([
            [
                'icon' => 'fa-solid fa-baby',
                'title' => 'Nhà trẻ (6 - 18 tháng)',
                'type' => Program::TYPE_AGE,
                'description' => 'Chăm sóc và nuôi dưỡng trẻ nhỏ an toàn, giúp bé phát triển thể chất và giác quan.',
            ],
            [
                'icon' => 'fa-solid fa-child',
                'title' => 'Mẫu giáo bé (3 - 4 tuổi)',
                'type' => Program::TYPE_AGE,
                'description' => 'Bé bắt đầu làm quen với các hoạt động học tập cơ bản và kỹ năng xã hội.',
            ],
            [
                'icon' => 'fa-solid fa-children',
                'title' => 'Mẫu giáo nhỡ (4 - 5 tuổi)',
                'type' => Program::TYPE_AGE,
                'description' => 'Tăng cường khả năng sáng tạo, học chữ cái và con số đơn giản.',
            ],
            [
                'icon' => 'fa-solid fa-user-graduate',
                'title' => 'Mẫu giáo lớn (5 - 6 tuổi)',
                'type' => Program::TYPE_AGE,
                'description' => 'Chuẩn bị hành trang kiến thức và kỹ năng trước khi vào lớp 1.',
            ],
            [
                'icon' => 'fa-solid fa-school',
                'title' => 'Chương trình tiền tiểu học',
                'type' => Program::TYPE_AGE,
                'description' => 'Tập trung phát triển tư duy logic, làm quen với môi trường học tập tiểu học.',
            ],

            // ----- TYPE_PROGRAM -----
            [
                'icon' => 'fa-solid fa-book',
                'title' => 'Chương trình học tập',
                'type' => Program::TYPE_PROGRAM,
                'description' => 'Giúp trẻ tiếp cận kiến thức cơ bản qua hình ảnh, trò chơi và câu chuyện.',
            ],
            [
                'icon' => 'fa-solid fa-music',
                'title' => 'Âm nhạc & Nghệ thuật',
                'type' => Program::TYPE_PROGRAM,
                'description' => 'Phát triển năng khiếu âm nhạc, khả năng biểu diễn và cảm thụ nghệ thuật.',
            ],
            [
                'icon' => 'fa-solid fa-basketball',
                'title' => 'Thể dục & Vận động',
                'type' => Program::TYPE_PROGRAM,
                'description' => 'Nâng cao sức khỏe thể chất qua các bài tập, trò chơi vận động ngoài trời.',
            ],
            [
                'icon' => 'fa-solid fa-earth-asia',
                'title' => 'Khám phá Khoa học & Thiên nhiên',
                'type' => Program::TYPE_PROGRAM,
                'description' => 'Khuyến khích trẻ tìm hiểu về thế giới xung quanh và phát triển tư duy khoa học.',
            ],
            [
                'icon' => 'fa-solid fa-handshake',
                'title' => 'Kỹ năng sống',
                'type' => Program::TYPE_PROGRAM,
                'description' => 'Trang bị cho trẻ những kỹ năng cơ bản trong giao tiếp, tự phục vụ và hợp tác.',
            ],
        ]);
    }
}
