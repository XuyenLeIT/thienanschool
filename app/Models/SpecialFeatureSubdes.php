<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialFeatureSubdes extends Model
{
    protected $fillable = ['special_feature_id','icon_class','title','description'];

    public function feature()
    {
        return $this->belongsTo(SpecialFeature::class);
    }
}
