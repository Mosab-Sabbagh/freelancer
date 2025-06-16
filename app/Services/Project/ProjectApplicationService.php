<?php 
namespace App\Services\Project;

use App\Models\JobPoster;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Notifications\NewApplicationNotification;
use App\Notifications\SeekerAccepted;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Gate;
class ProjectApplicationService{
    public function storeApplication(array $data)
    {
        $application = ProjectApplication::create($data);
        $poster = JobPoster::find($application->project->jobPoster->id);
        $poster->notify(new NewApplicationNotification($application));
        return $application;
    }

    public function hasAlreadyApplied($projectId, $jobSeekerId): bool
    {
        return ProjectApplication::where('project_id', $projectId)
            ->where('job_seeker_id', $jobSeekerId)
            ->exists();
    }

    // public function getProposalsBySeeker($jobSeekerId)
    // {
    //     return ProjectApplication::with('project') 
    //         ->where('job_seeker_id', $jobSeekerId)
    //         ->latest()
    //         ->get();
    // }

    public function getProposalsBySeeker($jobSeekerId, $statuses = [])
    {
        $query = ProjectApplication::with('project')
            ->where('job_seeker_id', $jobSeekerId);

        if (!empty($statuses)) {
            $query->whereIn('execution_status', $statuses);
        }

        return $query->latest()->get();
    }


    public function getApplicationsForProject($projectId)
    {
        $project = Project::findOrFail($projectId);

        // التحقق من أن المستخدم الحالي هو صاحب المشروع
        Gate::authorize('viewApplications', $project);
        
        // جلب الطلبات للمشروع المحدد
        return ProjectApplication::with(['jobSeeker', 'jobPoster'])
            ->where('project_id', $projectId)
            ->latest()
            ->get();
    }

    public function selectApplication(int $applicationId, int $jobPosterId): bool
    {
        return DB::transaction(function () use ($applicationId, $jobPosterId) {
            $application = ProjectApplication::findOrFail($applicationId);
            $project = Project::findOrFail($application->project_id);

            // التحقق أن المستخدم الحالي هو مالك المشروع
            if ($project->job_poster_id !== $jobPosterId) {
                throw new \Illuminate\Auth\Access\AuthorizationException('ليس لديك صلاحية لاختيار مستقل لهذا المشروع.');
            }

            // إلغاء التحديد لأي عرض آخر للمشروع نفسه
            ProjectApplication::where('project_id', $project->id)
                                ->update(['is_selected' => false]);

            // رفض جميع الطلبات الأخرى للمشروع
            ProjectApplication::where('project_id', $project->id)
                              ->where('id', '!=', $application->id) // استبعاد الطلب المحدد
                                ->update(['execution_status' => 'rejected']);

            // ثم اختر هذا الطلب وتحديث حالته
            $application->update([
                'is_selected' => true,
                'execution_status' => 'in_progress',
            ]);
            
            // notify the seeker that they have been selected
            // جلب المستخدم المرتبط بالمستقل
            $seeker = $application->jobSeeker;

            // إرسال الإشعار
            $seeker->notify(new SeekerAccepted($project));

            // تحديث حالة المشروع إلى "قيد الانتظار" (pending)
            $project->update([
                'status' => 'pending'
            ]);

            return true; 
        });
    }

}