<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'fullname',
        'parent',
        'phone',
        'grade',
        'startdate',
        'image',
        'classname',
        'bod',
        'age',
        'address',
        'gender',
        'status',
        'note',
        's_delete'
    ];

    // Mapping classname code → grade name
    public static $classGrades = [
        'TA001' => 'MẦM',
        'TA002' => 'CHỒI,LÁ',
        'TA003' => 'MẦM',
    ];

    // Mapping status → text
    public static $statusList = [
        0 => 'Đang làm hồ sơ',    // chưa nhập học
        1 => 'Đang bảo lưu',     // bảo lưu
        2 => 'Đang học',         // đang theo học
        3 => 'Đã nghỉ',          // đã nghỉ học
    ];
    public static $statusBadges = [
        0 => 'secondary', // Đang là hồ sơ
        1 => 'warning',   // Đang bảo lưu
        2 => 'success',   // Đang học
        3 => 'danger',    // Đã nghỉ
    ];

    public function getStatusBadge()
    {
        return self::$statusBadges[$this->status] ?? 'secondary';
    }

    public function getGradeLabel()
    {
        return self::$classGrades[$this->classname] ?? '';
    }

    public function getStatusLabel()
    {
        return self::$statusList[$this->status] ?? 'Không xác định';
    }
    protected $casts = [
        'startdate' => 'date',
        'bod' => 'date',
    ];
}

