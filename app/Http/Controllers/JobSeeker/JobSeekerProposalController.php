<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\Project\ProjectApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerProposalController extends Controller
{
    // public function index(ProjectApplicationService $projectApplicationService)
    // {
    //     $jobSeekerId = Auth::user()->jobSeeker->id;
    //     $proposals = $projectApplicationService->getProposalsBySeeker($jobSeekerId);

    //     return view('jobseeker.proposals.index', compact('proposals'));
    // }

    public function index(Request $request, ProjectApplicationService $projectApplicationService)
    {
        $jobSeekerId = Auth::user()->jobSeeker->id;
        $statuses = $request->input('execution_status', []);

        $proposals = $projectApplicationService->getProposalsBySeeker($jobSeekerId, $statuses);

        if ($request->ajax()) {
            return view('jobseeker.proposals.proposals_list', compact('proposals'))->render();
        }

        return view('jobseeker.proposals.index', compact('proposals'));
    }


}
