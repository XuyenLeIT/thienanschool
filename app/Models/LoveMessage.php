<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveMessage extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'message',
    ];
}
