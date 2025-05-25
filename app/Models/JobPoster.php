<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPoster extends Model
{
    protected $fillable = ['user_id','poster_type','phone','bio','profile_image','company_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class,'job_poster_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function applications()
    {
        return $this->hasMany(ProjectApplication::class);
    }


}
