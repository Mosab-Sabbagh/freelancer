<?php 
namespace App\Services\Payment;

use App\Models\Payment;
use App\Models\User;

class PaymentService
{
    public function createFor($payable, User $payer, float $amount, $method = 'manual')
    {
        return $payable->payments()->create([
            'payer_id' => $payer->id,
            'amount' => $amount,
            'payment_method' => $method,
            'status' => 'pending',
        ]);
    }

    public function markAsPaid(Payment $payment)
    {
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
    }
}
