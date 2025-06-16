<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $fillable = [
        'company_id',
        'title'	,
        'description',
        'service_id',
        'job_type',
        'salary_amount',
        'deadline',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
