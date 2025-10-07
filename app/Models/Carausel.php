<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carausel extends Model
{
      protected $fillable = ["title", "image", "description", "status", 'page'];
      const TYPE_HOME = 1;
      const TYPE_PARENT = 2;
      const TYPE_CURRICULUM = 3;
      const TYPE_ADMISSION = 4;
      const TYPE_CONTACT = 5;
        const TYPE_DETAIL = 6;

      const STATUS_HIDE = 0;
      const STATUS_SHOW = 1;

      public static function getTypes()
      {
            return [
                  self::TYPE_HOME => 'Home',
                  self::TYPE_PARENT => 'Parent',
                  self::TYPE_CURRICULUM => 'Curriculum',
                  self::TYPE_ADMISSION => 'Admission',
                  self::TYPE_CONTACT => 'Contact',
                  self::TYPE_DETAIL => 'Detail',
            ];
      }

      public static function getStatuses()
      {
            return [
                  self::STATUS_HIDE => 'Ẩn',
                  self::STATUS_SHOW => 'Hiển thị',
            ];
      }
}
