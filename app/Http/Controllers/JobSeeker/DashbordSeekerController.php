<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashbordSeekerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jobSeeker = $user->jobSeeker; 

        $jobSeekerServiceIds = $jobSeeker->services->pluck('id')->toArray();

        $latestProjectsInSameField = Project::whereIn('service_id', $jobSeekerServiceIds)
            ->with(['service', 'jobPoster.user', 'jobPoster.company']) // eager load relations for efficiency
            ->latest()
            ->take(5) 
            ->get();
        $data = [
            'latestProjects' => $latestProjectsInSameField,
            'user' => $user,
            // يمكنك إضافة jobSeeker أيضاً إذا احتجته في الواجهة الأمامية
            'jobSeeker' => $jobSeeker,
        ];

        return view('jobSeeker.dashbord', $data);
    }
}
