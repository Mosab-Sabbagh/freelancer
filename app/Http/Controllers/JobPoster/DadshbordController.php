<?php

namespace App\Http\Controllers\JobPoster;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DadshbordController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jobPoster = $user->jobPoster;

        $data = [
            'totalProjects' => Project::where('job_poster_id', $jobPoster->id)->where('status', 'open')->count(),
            'totalProjectsClosed' => Project::where('job_poster_id', $jobPoster->id)->where('status', 'closed')->count(),
            'latestProjects' => Project::where('job_poster_id', $jobPoster->id)->with('service')->latest()->take(5)->get(),
            'company' => $jobPoster->company, // إضافة بيانات الشركة
            'user' =>$user 
        ];

        return view('jobPoster.dashbord', $data);
    }

}
