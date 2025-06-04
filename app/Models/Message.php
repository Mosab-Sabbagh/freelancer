<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['chat_id', 'sender_id', 'sender_type', 'message'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender()
    {
        return $this->morphTo();  // علاقة morphTo مع المرسل (JobSeeker أو JobPoster)
    }
}
