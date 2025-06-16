<?php

namespace App\Http\Controllers\jobs;

use App\Http\Controllers\Controller;
use App\Services\Jobs\JobApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalJobController extends Controller
{
    public function index(Request $request, JobApplicationService $jobApplicationService)
    {

        $jobSeekerId = Auth::user()->jobSeeker->id;
        $statuses = $request->input('execution_status', []);

        $proposals = $jobApplicationService->getProposalsBySeeker($jobSeekerId, $statuses);
        if ($request->ajax()) {
            return view('jobSeeker.jobs.proposals.proposals_list', compact('proposals'))->render();
        }
        
        return view('jobSeeker.jobs.proposals.index', compact('proposals'));
    }
}
