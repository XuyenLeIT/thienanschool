<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
      protected $fillable = ['fullname', 'parent', 'phone','grade','startdate',
      'image','classname','bod','age','address','gender','status','note'];

   // Mapping classname code → grade name
    public static $classGrades = [
        'TA001' => 'MẦM',
        'TA002' => 'CHỒI,LÁ',
        'TA003' => 'MẦM',
    ];

    public function getGradeLabel()
    {
        return self::$classGrades[$this->classname] ?? '';
    }
}
