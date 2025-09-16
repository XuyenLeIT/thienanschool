<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialFeature extends Model
{
    protected $fillable = ['title', 'description'];

    public function images()
    {
        return $this->hasMany(SpecialFeatureImage::class);
    }

    public function subdes()
    {
        return $this->hasMany(SpecialFeatureSubdes::class);
    }
}
