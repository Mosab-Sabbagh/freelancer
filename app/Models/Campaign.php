<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name','description','goal_amount','raised_amount','status'];
    // public function donations()
    // {
    //     return $this->morphMany(Payment::class, 'payable');
    // }

}
