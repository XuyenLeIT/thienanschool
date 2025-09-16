<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'day' => 'Thứ 2',
                'breakfast' => 'Cháo thịt bằm, sữa tươi',
                'lunch' => 'Cơm, cá kho, canh rau cải',
                'snack' => 'Bánh flan, nước cam',
                'order' => 1,
            ],
            [
                'day' => 'Thứ 3',
                'breakfast' => 'Bún riêu cua, sữa đậu nành',
                'lunch' => 'Cơm, gà kho nấm, canh bí xanh',
                'snack' => 'Chuối chín, sữa chua',
                'order' => 2,
            ],
            [
                'day' => 'Thứ 4',
                'breakfast' => 'Xôi gấc, sữa Milo',
                'lunch' => 'Cơm, thịt heo xào đậu que, canh chua cá lóc',
                'snack' => 'Táo, bánh quy',
                'order' => 3,
            ],
            [
                'day' => 'Thứ 5',
                'breakfast' => 'Miến gà, sữa tươi',
                'lunch' => 'Cơm, trứng chiên thịt, canh cải ngọt',
                'snack' => 'Dưa hấu, sữa chua uống',
                'order' => 4,
            ],
            [
                'day' => 'Thứ 6',
                'breakfast' => 'Phở bò, sữa đậu nành',
                'lunch' => 'Cơm, cá chiên, canh rau dền',
                'snack' => 'Bánh bông lan, sữa tươi',
                'order' => 5,
            ],
        ];

        foreach ($schedules as $data) {
            Menu::create($data);
        }
    }
}
