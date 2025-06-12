<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
        protected $fillable = [
        'payable_type',
        'payable_id',
        'payer_id',
        'amount',
        'payment_method',
        'status',
        'paid_at',
    ];

    public function payable()
    {
        return $this->morphTo();
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }
}
