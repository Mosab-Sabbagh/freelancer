<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $fillable =[
        'owner_name',
        'governorate',
        'address',
        'phone_number',
        'available_time'
    ];

    
}
