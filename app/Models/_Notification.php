<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class _Notification extends Model
{
    protected $fillable = [
        'type',
        'read_at',
        'notifiable_id',
        'notifiable_type',
        'data'
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime'
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    // دالة لتحديد الإشعار كمقروء
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
        return $this;
    }

    // دالة للتحقق من حالة القراءة
    public function read()
    {
        return !is_null($this->read_at);
    }

    // دالة للتحقق من أن الإشعار غير مقروء
    public function unread()
    {
        return is_null($this->read_at);
    }

    // دالة لتحديد الإشعار كغير مقروء
    public function markAsUnread()
    {
        $this->update(['read_at' => null]);
        return $this;
    }
}
