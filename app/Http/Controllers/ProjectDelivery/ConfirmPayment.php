<?php

namespace App\Http\Controllers\ProjectDelivery;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class ConfirmPayment extends Controller
{
    public function index()
    {
        return view('jobSeeker.payment.confirmedPayment');
    }
    
    // to need validate for seeker with payment !!! 
    public function confirmPayment(Request $request , PaymentService $paymentService)
    {
        $payment = Payment::findOrFail($request->payment_id);

        // $project = Project::findOrFail($payment->payable_id);
        // $projectApplication = ProjectApplication::with('jobSeeker')->where('is_selected','=',1)->find($project->id);
        // $user_id = $projectApplication->jobSeeker->user->id;
        // dd('auth id = '.Auth::user()->id , '?=' , 'user project '.$user_id );
        // if($user_id != Auth::user()->id)
        // {
        //     return redirect()->back()->with('error','خطأ ما !!');
        // }

        
        $paymentService->markAsPaid($payment);
        return redirect()->route('jobSeeker.dash')->with('success', 'تم تأكيد الدفع بنجاح.');
    }
}
