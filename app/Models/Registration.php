<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'parent_name',
        'phone',
        'child_name',
        'age_group',
        'note',
        'status',
        'result',       // kết quả liên hệ: ví dụ "Bé đồng ý nhập học", "Đang tham khảo"
        'note_result',  // ghi chú thêm kết quả
    ];
}
