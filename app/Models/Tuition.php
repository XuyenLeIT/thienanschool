<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
   protected $fillable = ['grade', 'fee', 'note'];
}
