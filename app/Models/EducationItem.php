<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationItem extends Model
{
    protected $fillable = ['education_content_id', 'image', 'overlay_text', 'sort_order'];

    public function content()
    {
        return $this->belongsTo(EducationContent::class, 'education_content_id');
    }
}
