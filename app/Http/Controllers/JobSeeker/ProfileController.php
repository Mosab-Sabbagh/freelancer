<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JobSeeker\JobSeekerService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(JobSeekerService $service)
    {
        $this->service = $service;
    }
    public function edit()
    {
        return view('jobSeeker.profile.edit');
    }

    public function update(Request $request, JobSeekerService $service)
    {
        $service->updateProfile(Auth::user(), $request->all());

        return redirect()->route('jobSeeker.dash')->with('success', 'تم تحديث البيانات بنجاح.');
        
    }
}
