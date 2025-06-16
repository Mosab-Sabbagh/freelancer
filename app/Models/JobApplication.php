<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id',
        'job_seeker_id',
        'company_id',
        'is_selected',
        'execution_status',
        'notes'
    ];

    public function job()
    {
        return $this->belongsTo(JobPost::class, 'job_id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(JobSeeker::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
