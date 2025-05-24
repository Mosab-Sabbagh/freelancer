<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::count(),
            // 'activeJobs' => Job::where('status', 'active')->count(),
            // 'jobApplications' => JobApplication::count(),
            'totalCompanies' => Company::count(),
            'latestUsers' => User::latest()->take(5)->get(),
            // 'latestJobs' => Job::with('company')->latest()->take(5)->get(),
        ];
        

        return view('admin.dashboard', $data);
    }
} 