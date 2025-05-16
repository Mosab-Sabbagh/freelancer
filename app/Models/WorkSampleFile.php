<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSampleFile extends Model
{
    protected $fillable = [
        'work_sample_id',
        'file_path',
        'is_main'
    ];

    public function workSample()
    {
        return $this->belongsTo(WorkSample::class);
    }
}
