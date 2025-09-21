<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Account extends Model
{
    protected $fillable = [
        'email',
        'password',
        'role',
        'address',
        'admin_approve',
        'startdate',
        'fullname',
        'phone',
        'status',
        'note',
        'startdate',
        'manage_class',
    ];
    /**
     * Casts tự động
     */
    protected $casts = [
        'startdate' => 'datetime',   // Laravel sẽ convert sang Carbon object
        'status' => 'boolean',    // true/false
        'admin_approve' => 'boolean',    // true/false
    ];

    /**
     * Ẩn password khi serialize
     */
    protected $hidden = [
        'password',
    ];
    // Hash password khi lưu
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // kiểm tra mật khẩu
    public function checkPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    // các hàm role
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }
    public function isKitchen(): bool
    {
        return $this->role === 'kitchen';
    }
    public function isNanny(): bool
    {
        return $this->role === 'nanny';
    }
}
