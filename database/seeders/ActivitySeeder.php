<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $activities = [
            // ---- TYPE_STUDY ----
            [
                'title' => 'Khám phá chữ cái',
                'image' => 'uploads/images/study1.jpg',
                'shortdes' => 'Trẻ làm quen bảng chữ cái.',
                'description' => 'Hoạt động giúp trẻ nhận biết và phân biệt các chữ cái qua trò chơi và hình ảnh.',
                'type' => Activity::TYPE_STUDY,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Làm quen với số đếm',
                'image' => 'uploads/images/study2.jpg',
                'shortdes' => 'Trẻ học đếm từ 1 đến 10.',
                'description' => 'Giúp trẻ phát triển tư duy toán học cơ bản.',
                'type' => Activity::TYPE_STUDY,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Khám phá thế giới quanh ta',
                'image' => 'uploads/images/study3.jpg',
                'shortdes' => 'Bé học về thiên nhiên.',
                'description' => 'Trẻ tìm hiểu về cây cối, động vật và môi trường xung quanh.',
                'type' => Activity::TYPE_STUDY,
                'status' => Activity::STATUS_HIDE,
            ],

            // ---- TYPE_FUN ----
            [
                'title' => 'Vẽ tranh sáng tạo',
                'image' => 'uploads/images/fun1.jpg',
                'shortdes' => 'Bé tập tô màu.',
                'description' => 'Phát triển óc sáng tạo và thẩm mỹ qua hoạt động vẽ tranh.',
                'type' => Activity::TYPE_FUN,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Trò chơi vận động',
                'image' => 'uploads/images/fun2.jpg',
                'shortdes' => 'Rèn luyện sức khỏe.',
                'description' => 'Các trò chơi tập thể như kéo co, nhảy bao bố.',
                'type' => Activity::TYPE_FUN,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Âm nhạc và nhảy múa',
                'image' => 'uploads/images/fun3.jpg',
                'shortdes' => 'Bé tập hát và nhảy.',
                'description' => 'Trẻ hòa mình vào âm nhạc, rèn luyện sự tự tin.',
                'type' => Activity::TYPE_FUN,
                'status' => Activity::STATUS_HIDE,
            ],

            // ---- TYPE_NEWS ----
            [
                'title' => 'Thông báo nghỉ lễ 30/4',
                'image' => 'uploads/images/news1.jpg',
                'shortdes' => 'Nghỉ lễ Quốc tế Lao động.',
                'description' => 'Nhà trường thông báo lịch nghỉ lễ 30/4 và 1/5.',
                'type' => Activity::TYPE_NEWS,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Ngày hội thể thao',
                'image' => 'uploads/images/news2.jpg',
                'shortdes' => 'Sự kiện thể thao cho trẻ.',
                'description' => 'Trường tổ chức ngày hội thể thao cho các bé và phụ huynh.',
                'type' => Activity::TYPE_NEWS,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Thông báo tuyển sinh năm học mới',
                'image' => 'uploads/images/news3.jpg',
                'shortdes' => 'Tuyển sinh cho các lớp mầm non.',
                'description' => 'Chi tiết về thời gian, hồ sơ và quy trình đăng ký nhập học.',
                'type' => Activity::TYPE_NEWS,
                'status' => Activity::STATUS_HIDE,
            ],

            // ---- TYPE_ADVICE ----
            [
                'title' => 'Dinh dưỡng cho trẻ mầm non',
                'image' => 'uploads/images/advice1.jpg',
                'shortdes' => 'Chế độ ăn cho bé.',
                'description' => 'Lời khuyên từ chuyên gia về chế độ dinh dưỡng cân đối cho trẻ.',
                'type' => Activity::TYPE_ADVICE,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Kỹ năng tự lập cho trẻ',
                'image' => 'uploads/images/advice2.jpg',
                'shortdes' => 'Bé tự làm việc cá nhân.',
                'description' => 'Hướng dẫn phụ huynh giúp con rèn luyện sự tự lập từ nhỏ.',
                'type' => Activity::TYPE_ADVICE,
                'status' => Activity::STATUS_SHOW,
            ],
            [
                'title' => 'Cách xử lý khi trẻ khóc',
                'image' => 'uploads/images/advice3.jpg',
                'shortdes' => 'Kinh nghiệm cho phụ huynh.',
                'description' => 'Những mẹo nhỏ giúp cha mẹ bình tĩnh và hướng dẫn bé vượt qua cảm xúc.',
                'type' => Activity::TYPE_ADVICE,
                'status' => Activity::STATUS_HIDE,
            ],
        ];

        foreach ($activities as $data) {
            Activity::create($data);
        }

        // Activity::truncate(); // xóa toàn bộ dữ liệu bảng activities
    }
}
