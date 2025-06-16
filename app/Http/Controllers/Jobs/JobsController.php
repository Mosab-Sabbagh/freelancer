<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Jobs\JobPostService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class JobsController extends Controller
{
    use AuthorizesRequests;

    protected $jobPostService ;
    public function __construct(JobPostService $jobPostService)
    {
        $this->jobPostService = $jobPostService;
    }
    // use policy .. 
    // public function create()
    // {
    //         $this->authorize('create','jobPost');
    //         $services = Service::all();
    //         return view('jobPoster.company.job.create',compact('services'));
    // }


    public function create()
    {
        if(Auth::user()->jobPoster->company)
        {
            $services = Service::all();
            return view('jobPoster.company.job.create',compact('services'));
        }
        return redirect()->back();
    }



    public function store(Request $request)
    {
        
        try{
            $request->validate([
                'title' => 'required|string' , 
                'description' => 'required|string',
                'service_id'=> 'required',
                'job_type'=> 'required',
                'salary_amount'=> 'required',
                'deadline'=> 'required',
            ]);
            $this->jobPostService->storeJob($request->all());
            return redirect()->route('jobPoster.dash')->with('success', 'تم نشر الوظيفة بنجاح');
        }catch(Exception $e){
            Log::info($e);
            return redirect()->route('jobPoster.dash')->with('error','حدث خطأ ما خلال نشر الوظيفة انشر لاحقاً...');
        } 
    }

    public function index()
    {
        $jobs = $this->jobPostService->getJobsForCurrentUser();
        return view('jobPoster.company.job.index', compact('jobs'));
    }


}
