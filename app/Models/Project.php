<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['job_poster_id','title','description','deadline','status','service_id','budget_from','budget_to','attachment'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function jobPoster()
    {
        return $this->belongsTo(JobPoster::class);
    }

    public function applications()
    {
        return $this->hasMany(ProjectApplication::class);
    }

}
