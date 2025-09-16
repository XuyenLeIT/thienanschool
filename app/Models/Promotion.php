<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'type',
        'status'
    ];

    const STATUS_HIDE = 0;
    const STATUS_SHOW = 1;

    public static function getStatuses()
    {
        return [
            self::STATUS_HIDE => 'Ẩn',
            self::STATUS_SHOW => 'Hiển thị',
        ];
    }

    const TYPE_PROGRAM = 1;
    const TYPE_PARENT = 2;
    const TYPE_ADMISSION = 3;

    public static function getTypes()
    {
        return [
            self::TYPE_PROGRAM => 'PROGRAM',
            self::TYPE_PARENT => 'PARENT',
            self::TYPE_ADMISSION => 'ADMISSION',
        ];
    }
}
