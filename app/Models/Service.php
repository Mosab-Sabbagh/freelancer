<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name'];

    public function jobSeekers()
    {
        return $this->belongsToMany(JobSeeker::class, 'job_seeker_service');
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

}
