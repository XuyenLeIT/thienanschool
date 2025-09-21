<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'email' => 'admin@example.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'fullname' => 'Nguyễn Văn Admin',
                'phone' => '0901234567',
                'address' => 'Hà Nội',
                'admin_approve' => true,
                'status' => true,
                'note' => 'Quản trị hệ thống',
                'startdate' => '2022-01-01',
                'manage_class' => null,
            ],
            [
                'email' => 'manager1@example.com',
                'password' => Hash::make('123456'),
                'role' => 'manager',
                'fullname' => 'Trần Thị Manager',
                'phone' => '0912345678',
                'address' => 'Hồ Chí Minh',
                'admin_approve' => true,
                'status' => true,
                'note' => 'Quản lý phòng học',
                'startdate' => '2023-03-15',
                'manage_class' => null,
            ],
            [
                'email' => 'teacher1@example.com',
                'password' => Hash::make('123456'),
                'role' => 'teacher',
                'fullname' => 'Phạm Văn Teacher',
                'phone' => '0923456789',
                'address' => 'Đà Nẵng',
                'admin_approve' => true,
                'status' => true,
                'note' => 'Giáo viên lớp A1',
                'startdate' => '2023-09-01',
                'manage_class' => 'A1',
            ],
            [
                'email' => 'kitchen1@example.com',
                'password' => Hash::make('123456'),
                'role' => 'kitchen',
                'fullname' => 'Lê Thị Kitchen',
                'phone' => '0934567890',
                'address' => 'Hải Phòng',
                'admin_approve' => true,
                'status' => true,
                'note' => 'Nhân viên bếp',
                'startdate' => '2023-06-10',
                'manage_class' => null,
            ],
            [
                'email' => 'nanny1@example.com',
                'password' => Hash::make('123456'),
                'role' => 'nanny',
                'fullname' => 'Hoàng Thị Nanny',
                'phone' => '0945678901',
                'address' => 'Cần Thơ',
                'admin_approve' => false,
                'status' => true,
                'note' => 'Trông trẻ lớp B2',
                'startdate' => '2023-07-01',
                'manage_class' => null,
            ],
        ];

        foreach ($accounts as $account) {
            Account::create($account);
        }
    }
}
