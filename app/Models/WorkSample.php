<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSample extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'project_date',
        'technologies',
        'preview_link',
        'duration',
        'category',
    ];

    public function files()
    {
        return $this->hasMany(WorkSampleFile::class);
    }
    
    public function mainImage()
    {
        return $this->hasOne(WorkSampleFile::class)->where('is_main', true);
    }

}
