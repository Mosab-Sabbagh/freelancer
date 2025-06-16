<?php 
namespace App\Services\Jobs;

use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;

class JobPostService {
    public function storeJob($data)
    {
        $jobPost = new JobPost();
        $jobPost->company_id = Auth::user()->jobPoster->company->id;
        $jobPost->title = $data['title'];
        $jobPost->description = $data['description'];
        $jobPost->service_id = $data['service_id'];
        $jobPost->job_type = $data['job_type'];
        $jobPost->salary_amount = $data['salary_amount'];
        $jobPost->deadline = $data['deadline'];
        $jobPost->status = 'open';
        $jobPost->save();
    }

    public function getJobsForCurrentUser()
    {
        return JobPost::where('company_id', Auth::user()->jobPoster->company->id)->get();
    }

    
    public function filterJobs($request)
    {
        return JobPost::query()
            ->withCount('applications') // يحسب العدد فقط (ويخزنه في applications_count) بشكل افتراضي
            ->with('service') 
            ->when($request->filled('service_id'), fn ($q) => $q->whereIn('service_id', (array) $request->service_id))
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(20);
    }

    public function detailsJob($id)
    {
        return JobPost::findOrFail($id);
    }


}