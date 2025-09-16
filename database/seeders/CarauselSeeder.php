<?php

namespace Database\Seeders;

use App\Models\Carausel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarauselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     Carausel::insert([
            [
                'title' => 'Trang chủ Trường Mầm Non',
                'image' => 'uploads/images/home.jpg',
                'description' => 'Thông tin tổng quan, hình ảnh nổi bật và các hoạt động của trường.',
                'status' => Carausel::STATUS_SHOW,
                'page' => Carausel::TYPE_HOME,
            ],
            [
                'title' => 'Thông tin Phụ huynh',
                'image' => 'uploads/images/parent.jpg',
                'description' => 'Các bài viết, chia sẻ và kinh nghiệm dành cho phụ huynh.',
                'status' => Carausel::STATUS_SHOW,
                'page' => Carausel::TYPE_PARENT,
            ],
            [
                'title' => 'Chương trình giảng dạy',
                'image' => 'uploads/images/curriculum.jpg',
                'description' => 'Mô tả chi tiết chương trình học theo từng độ tuổi.',
                'status' => Carausel::STATUS_SHOW,
                'page' => Carausel::TYPE_CURRICULUM,
            ],
            [
                'title' => 'Thông tin Tuyển sinh',
                'image' => 'uploads/images/admission.jpg',
                'description' => 'Quy trình đăng ký, nộp hồ sơ và thời gian tuyển sinh.',
                'status' => Carausel::STATUS_SHOW,
                'page' => Carausel::TYPE_ADMISSION,
            ],
            [
                'title' => 'Liên hệ Nhà trường',
                'image' => 'uploads/images/contact.jpg',
                'description' => 'Thông tin liên hệ, địa chỉ và bản đồ đến trường.',
                'status' => Carausel::STATUS_HIDE,
                'page' => Carausel::TYPE_CONTACT,
            ],
        ]);
    }
}
