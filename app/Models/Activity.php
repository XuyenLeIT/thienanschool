<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Activity extends Model
{
    protected $fillable = ["title", "image", "shortdes", "description","slug", 'type', 'status'];

    const TYPE_STUDY = 1;
    const TYPE_FUN = 2;
    const TYPE_NEWS = 3;
    const TYPE_ADVICE = 4;
    const STATUS_HIDE = 0;
    const STATUS_SHOW = 1;

    public static function getTypes()
    {
        return [
            self::TYPE_STUDY => 'Hoạt động học tập',
            self::TYPE_FUN => 'Hoạt động vui chơi',
            self::TYPE_NEWS => 'Tin Tức',
            self::TYPE_ADVICE => 'Tư Vấn',
        ];
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_HIDE => 'Ẩn',
            self::STATUS_SHOW => 'Hiển thị',
        ];
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($activity) {
            $slug = Str::slug($activity->title);
            $originalSlug = $slug;
            $count = 1;

            while (Activity::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $activity->slug = $slug;
        });
        static::updating(function ($activity) {
            $slug = Str::slug($activity->title);
            $originalSlug = $slug;
            $count = 1;

            while (
                Activity::where('slug', $slug)
                    ->where('id', '!=', $activity->id)
                    ->exists()
            ) {
                $slug = $originalSlug . '-' . $count++;
            }

            $activity->slug = $slug;
        });
    }
}
