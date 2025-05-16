<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManagementUserServices;
use App\Services\Admin\ServiceService;
use App\Services\Admin\SkillService;
use Illuminate\Http\Request;
use App\Services\JobSeeker\JobSeekerService;
use App\UserRole;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(JobSeekerService $service)
    {
        $this->service = $service;
    }

    
    public function edit(SkillService $skillService , ServiceService $service , JobSeekerService $jobSeekerService ,ManagementUserServices $management_user , $id)
    {
        $skills = $skillService->getAll();
        $services = $service->getAll();
        $user = $management_user->getById($id);
        return view('jobSeeker.profile.edit',compact("skills","services", "user"));
    }

    public function update(Request $request, JobSeekerService $service,$user_id)
    {
        $service->updateProfile($user_id, $request->all());

        return redirect()->route('jobSeeker.dash')->with('success', 'تم تحديث البيانات بنجاح.');
        
    }

    public function updatePassword()
    {
        return view('jobSeeker.profile.update_password');
    }
    
    public function profile(JobSeekerService $jobSeeker,ManagementUserServices $management_user,$id)
    {
        $user = $management_user->getById($id);
        $seeker = $jobSeeker->infoSeeker($id);
        return view('jobSeeker.profile.profile',compact("seeker","user"));
    }


}
