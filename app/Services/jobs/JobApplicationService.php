<?php 
namespace App\Services\Jobs;

use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\JobPoster;
use App\Notifications\NewJobApplicationNotification;
use App\Notifications\SeekerAcceptedForJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class JobApplicationService{
    public function storeJobApplication($data)
    { 
        $job_application = JobApplication::create($data);
        $poster = JobPoster::find($job_application->company->jobPoster->id);
        $poster->notify(new NewJobApplicationNotification($job_application));
        return $job_application;
    }

    public function hasAlreadyApplied($JobId, $jobSeekerId): bool
    {
        return JobApplication::where('job_id', $JobId)
            ->where('job_seeker_id', $jobSeekerId)
            ->exists();
    }

    public function getApplicationsForJob($jobId)
    {
        $job = JobPost::findOrFail($jobId);

        // التحقق من أن المستخدم الحالي هو صاحب المشروع

        if (Auth::user()->id !== $job->company->jobPoster->user_id) {
            abort(403, 'ليس لديك صلاحية لعرض الطلبات لهذا المشروع.');
        }
        // جلب الطلبات للمشروع المحدد
        return JobApplication::with(['jobSeeker'])
            ->where('job_id', $jobId)
            ->latest()
            ->get();
    }

    public function selectApplication(int $applicationId, int $company_id): bool
    {
        return DB::transaction(function () use ($applicationId, $company_id) {
            $application = JobApplication::findOrFail($applicationId);
            $job = JobPost::findOrFail($application->job_id);

            // التحقق أن المستخدم الحالي هو مالك المشروع
            if ($job->company_id !== $company_id) {
                throw new \Illuminate\Auth\Access\AuthorizationException('ليس لديك صلاحية لاختيار مستقل لهذا المشروع.');
            }

            // إلغاء التحديد لأي عرض آخر للمشروع نفسه
            JobApplication::where('job_id', $job->id)
                                ->update(['is_selected' => false]);

            // رفض جميع الطلبات الأخرى للمشروع
            JobApplication::where('job_id', $job->id)
                                ->where('id', '!=', $application->id) // استبعاد الطلب المحدد
                                ->update(['execution_status' => 'rejected']);

            // ثم اختر هذا الطلب وتحديث حالته
            $application->update([
                'is_selected' => true,
                'execution_status' => 'accepted',
            ]);
            
            // جلب المستخدم المرتبط بالمستقل
            $seeker = $application->jobSeeker;

            // إرسال الإشعار
            $seeker->notify(new SeekerAcceptedForJob($job));

            // تحديث حالة الوظيفة إلى 
            $job->update([
                'status' => 'closed'
            ]);

            return true; 
        });
    }

    public function getProposalsBySeeker($jobSeekerId, $statuses = [])
    {
        $query = JobApplication::with('job')
            ->where('job_seeker_id', $jobSeekerId);

        if (!empty($statuses)) {
            $query->whereIn('execution_status', $statuses);
        }

        return $query->latest()->get();
    }


    public static function countApplicationsForJob($jobId)
    {
        $jobPost = JobPost::findOrFail($jobId);
        return JobApplication::where('job_id',$jobId)->count();
    }
}
