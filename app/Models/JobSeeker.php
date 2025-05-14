<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{



    protected $fillable = ['user_id', 'job_field_id', 'bio'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobField()
    {
        return $this->belongsTo(JobField::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_seeker_skill');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'job_seeker_services');
    }
}
