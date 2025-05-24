<?php

namespace App\Http\Controllers\JobPoster;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Services\Project\projectService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{

    protected $projectService;

    public function __construct(projectService $projectService)
    {
        $this->projectService = $projectService;
    }


    public function index()
    {
        $projects = $this->projectService->getProjectsForCurrentUser();
        return view('jobposter.projects.index', compact('projects'));
    }

    public function create()
    {
        $services = Service::all();
        return view('jobposter.projects.create', compact('services'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required',
                'budget_from' => 'nullable|numeric|min:0',
                'budget_to' => 'nullable|numeric|gte:budget_from',
                'deadline' => 'nullable|date',
                'service_id' => 'required|exists:services,id',
                'attachment' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
            ]);

            $this->projectService->createProject($request->all());

            return redirect()->route('jobposter.projects.index')->with('success', 'تم إنشاء المشروع بنجاح.');
        } catch (Exception $e) {
            Log::info($e);
            return redirect()->back()->with('error', 'حدث خطأ أثناء حفظ المشروع');
        }
    }


}
