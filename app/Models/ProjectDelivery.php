<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDelivery extends Model
{
    protected $fillable = [
        'project_id', 'job_seeker_id', 'delivery_notes',
        'delivery_file', 'delivered_at', 'confirmed_at',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function seeker()
    {
        return $this->belongsTo(JobSeeker::class, 'job_seeker_id');
    }
}
