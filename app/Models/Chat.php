<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['project_id', 'seeker_id', 'poster_id'];
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function seeker()
    {
        return $this->belongsTo(JobSeeker::class, 'seeker_id');
    }

    public function poster()
    {
        return $this->belongsTo(JobPoster::class, 'poster_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
