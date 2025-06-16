<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProjectApplication extends Model
{
    use Notifiable;
    protected $fillable = [
        'project_id',
        'job_seeker_id',
        'job_poster_id',
        'proposed_price',
        'execution_days',
        'is_selected',
        'execution_status',
        'notes',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function jobPoster()
    {
        return $this->belongsTo(JobPoster::class);
    }
    public function delivery()
    {
        return $this->hasOne(ProjectDelivery::class, 'project_id', 'project_id')
                    ->where('job_seeker_id', $this->job_seeker_id);
    }

}
