<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['job_poster_id','name','email','phone','website',
    'address','description','logo'];
    public function jobPoster()
    {
        return $this->belongsTo(JobPoster::class,'job_poster_id');
    }
}
