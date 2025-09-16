<?php

namespace Database\Seeders;

use App\Models\DailySchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'time' => '07:30 - 08:00',
                'activity' => 'Đón trẻ, trò chuyện đầu ngày',
                'order' => 1,
            ],
            [
                'time' => '08:00 - 08:30',
                'activity' => 'Thể dục buổi sáng',
                'order' => 2,
            ],
            [
                'time' => '08:30 - 09:00',
                'activity' => 'Ăn sáng',
                'order' => 3,
            ],
            [
                'time' => '09:00 - 10:00',
                'activity' => 'Hoạt động học tập chính (Toán, Văn, Nhạc…)',
                'order' => 4,
            ],
            [
                'time' => '10:00 - 10:30',
                'activity' => 'Hoạt động vui chơi ngoài trời',
                'order' => 5,
            ],
            [
                'time' => '10:30 - 11:00',
                'activity' => 'Vệ sinh cá nhân, chuẩn bị ăn trưa',
                'order' => 6,
            ],
            [
                'time' => '11:00 - 12:00',
                'activity' => 'Ăn trưa',
                'order' => 7,
            ],
            [
                'time' => '12:00 - 14:00',
                'activity' => 'Ngủ trưa',
                'order' => 8,
            ],
            [
                'time' => '14:00 - 14:30',
                'activity' => 'Ăn xế (ăn nhẹ)',
                'order' => 9,
            ],
            [
                'time' => '14:30 - 15:30',
                'activity' => 'Hoạt động nghệ thuật, kỹ năng sống',
                'order' => 10,
            ],
            [
                'time' => '15:30 - 16:00',
                'activity' => 'Chơi tự do, hoạt động góc',
                'order' => 11,
            ],
            [
                'time' => '16:00 - 17:00',
                'activity' => 'Trả trẻ, trao đổi với phụ huynh',
                'order' => 12,
            ],
        ];

        foreach ($schedules as $data) {
            DailySchedule::create($data);
        }
    }
}
