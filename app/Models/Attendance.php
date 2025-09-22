<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   protected $fillable = ['student_id', 'teacher_id', 'date', 'classname', 'status', 'note'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Account::class, 'teacher_id');
    }
}
