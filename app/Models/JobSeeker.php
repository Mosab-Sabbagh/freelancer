<?php

namespace App\Models;

// use App\Trait\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class JobSeeker extends Model
{

    use Notifiable;
    // use Notification;

    protected $fillable = ['user_id', 'bio','profile_picture','is_available','hourly_rate','experience_level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_seeker_skill');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'job_seeker_service');
    }

    public function applications()
    {
        return $this->hasMany(ProjectApplication::class);
    }

    public function messages()
    {
        return $this->morphMany(Message::class, 'sender');
    }
    // public function notifications()
    // {
    //     return $this->morphMany(Notification::class, 'notifiable');
    // }

    // public function unreadNotifications()
    // {
    //     return $this->notifications()->whereNull('read_at');
    // }

}
