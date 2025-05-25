<?php 
namespace App\Services\Project;

use App\Models\ProjectApplication;

class ProjectApplicationService{
    public function storeApplication(array $data)
    {
        return ProjectApplication::create($data);
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






}