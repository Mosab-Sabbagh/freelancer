<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{



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

}
