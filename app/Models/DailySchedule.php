<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySchedule extends Model
{
    protected $fillable = ['time', 'activity',"order"];
}
