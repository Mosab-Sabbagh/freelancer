<?php

namespace App\Http\Controllers\JobPoster;

use App\Http\Controllers\Controller;
use App\Models\JobPoster;
use App\Services\JobPoster\JobPosterService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobPosterController extends Controller
{
    protected $jobPosterService;

    public function __construct(JobPosterService $jobPosterService)
    {
        $this->jobPosterService = $jobPosterService;
    }

    public function edit()
    {
        $result = $this->jobPosterService->getEditViewData();

        if ($result['view']) {
            return view($result['view'], $result['data']);
        }

        return redirect()->back()->with('error', $result['error']);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'phone' => 'required|string',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $success = $this->jobPosterService->updateJobPoster($request, $id);

        if (!$success) {
            return redirect()->back()->with('error', 'لم يتم العثور على المستخدم.');
        }

        return redirect()->route('jobPoster.dash')->with('success', 'تم تحديث البيانات بنجاح');
    }
    
    public function profile($id)
    {
        $jobPoster = JobPoster::findOrFail($id);
        if($jobPoster->poster_type === 'individual'){
            return view('jobPoster.profile.profile',compact("jobPoster"));
        }elseif($jobPoster->poster_type === 'company'){
            $companyPoster = $jobPoster->company;
            // dd($companyPoster);
            return view('jobPoster.company.profile',compact("companyPoster"));
        }
    }



}
