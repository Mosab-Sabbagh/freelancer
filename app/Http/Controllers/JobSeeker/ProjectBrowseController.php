<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Project\ProjectApplicationService;
use App\Services\Project\projectService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectBrowseController extends Controller
{
    public function index(Request $request ,projectService $projectService)
    {
        $projects = $projectService->filterProjects($request);
        $services = Service::all();
        
        if ($request->ajax()) {
            return view('jobSeeker.projects._projects_list', compact('projects'))->render();
        }
        
        return view('jobSeeker.projects.index', compact('projects', 'services'));
    }

    public function details(ProjectService $projectService,$id,ProjectApplicationService $projectApplicationService)
    {
        try{
            $isApplied = $projectApplicationService->hasAlreadyApplied($id,Auth::user()->jobSeeker->id);
            $project = $projectService->detailsProject($id);
            return view('jobSeeker.projects.details',compact('project','isApplied'));
        }catch(Exception $e)
        {
            Log::info($e);
            return redirect()->back()->with('error','هناك خطأ ما أو الخدمة التي تبحث عنها غير موجودة');
        }
    }
}
