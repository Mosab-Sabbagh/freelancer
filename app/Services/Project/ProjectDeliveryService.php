<?php 
namespace App\Services\Project;

use App\Models\JobPoster;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\ProjectDelivery;
use App\Notifications\ConfirmDelivery;
use App\Notifications\ProjectConfirmedNotification;
use App\Services\Payment\PaymentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectDeliveryService
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function storeDelivery(Project $project, array $data)
    {
        $jobSeekerId = Auth::user()->jobSeeker->id;

        // التحقق إذا تم التسليم من قبل
        $alreadyDelivered = ProjectDelivery::where('project_id', $project->id)
            ->where('job_seeker_id', $jobSeekerId)
            ->exists();

        if ($alreadyDelivered) {
            throw new \Exception('لقد قمت بتسليم هذا المشروع بالفعل، بانتظار التأكيد.');
        }


        $filePath = null;

        if (isset($data['delivery_file'])) {
            $filePath = $data['delivery_file']->store('deliveries');
        }

        $delivery = ProjectDelivery::create([
            'project_id' => $project->id,
            'job_seeker_id' => Auth::user()->jobSeeker->id,
            'delivery_notes' => $data['delivery_notes'],
            'delivery_file' => $filePath,
            'delivered_at' => now(),
        ]);

        // إرسال إشعار للبوستر
        $poster = JobPoster::find($project->job_poster_id);
        $poster?->notify(new ConfirmDelivery($project));

        return $delivery;
    }

    public function confirmDelivery(ProjectDelivery $delivery)
    {
        DB::transaction(function () use ($delivery) {
            $delivery->update(['confirmed_at' => now()]);

            $project = $delivery->project;
            $project->update(['status' => 'closed']);

            $application = ProjectApplication::where('project_id', $delivery->project_id)
            ->where('job_seeker_id', $delivery->job_seeker_id)
            ->first();

            if ($application) {
            $application->update(['execution_status' => 'completed']);
            }

            $this->paymentService->createFor($project, Auth::user(), $application->proposed_price);
            
            $delivery->seeker?->notify(new ProjectConfirmedNotification($delivery));
        });
    }
}