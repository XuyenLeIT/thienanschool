<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationContent extends Model
{
   protected $fillable = ['title', 'main_image', 'caption', 'description'];

    public function items()
    {
        return $this->hasMany(EducationItem::class);
    }
}
