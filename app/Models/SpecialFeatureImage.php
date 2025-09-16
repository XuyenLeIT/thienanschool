<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialFeatureImage extends Model
{
    protected $fillable = ['special_feature_id','image'];

    public function feature()
    {
        return $this->belongsTo(SpecialFeature::class);
    }
}
