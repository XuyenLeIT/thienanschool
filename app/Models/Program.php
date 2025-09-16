<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
   protected $fillable = ['icon', 'title','type', 'description'];
    const TYPE_AGE  = 1;
    const TYPE_PROGRAM = 2;
    public static function getTypes()
    {
        return [
            self::TYPE_AGE => 'Độ tuổi học tập',
            self::TYPE_PROGRAM => 'Chương trình học',
        ];
    }
}
