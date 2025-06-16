<?php

namespace App\Http\Controllers\jobs;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Jobs\JobApplicationService;
use App\Services\Jobs\JobPostService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostBrowseController extends Controller
{
    public function index(Request $request,JobPostService $jobPostService)
    {
        $jobs = $jobPostService->filterJobs($request);
        $services = Service::all();
        if ($request->ajax()) {
            return view('jobSeeker.jobs._jobs_list', compact('jobs'))->render();
        }
        
        return view('jobSeeker.jobs.index', compact('jobs', 'services'));
    }

    public function details(JobPostService $jobPostService, JobApplicationService $jobApplicationService , $id)
    {
        try{
            $job = $jobPostService->detailsJob($id);
            $isApplied = $jobApplicationService->hasAlreadyApplied($id,Auth::user()->jobSeeker->id);
            return view('jobSeeker.jobs.details',compact('job','isApplied'));
        }catch(Exception $e){
            return redirect()->back()->with('error','هناك خطأ ما أو الوظيفة التي تبحث عنها غير موجودة');
        }
    }
}
