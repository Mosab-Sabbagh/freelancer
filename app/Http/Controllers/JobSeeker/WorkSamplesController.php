<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeeker\WorkSamplesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkSamplesController extends Controller
{
    public function add()
    {
        return view('jobSeeker.worksample.add');
    }
    
    public function store(Request $request,WorkSamplesService $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_date' => 'nullable|date',
            'technologies' => 'nullable|string|max:255',
            'preview_link' => 'nullable|url|max:255',
            'duration' => 'nullable|string|max:100',
            'category' => 'required|string|max:100',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $service->handleStore($request);

        return redirect()->route('jobSeeker.dash')->with('success','تم اضافة العمل بنجاح');
    }

    public function index(WorkSamplesService $service)
    {
        $WorkSamples = $service->getAll();
        return view('jobSeeker.worksample.index',compact("WorkSamples",));
    }
    public function show(WorkSamplesService $service,$id)
    {
        $work = $service->getById($id);
        return view('jobSeeker.worksample.details',compact("work"));
    }

    public function destroy(WorkSamplesService $service,$id)
    {
        $service->delete($id);
        return redirect()->route('worksample.index')->with('success','تم حذف المشروع بنجاح');
    }

    public function edit(WorkSamplesService $service,$id)
    {
        $work = $service->getById($id);
        return view('jobSeeker.worksample.edit',compact('work'));
    }

    public function update(Request $request, $id, WorkSamplesService $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_date' => 'nullable|date',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'delete_files' => 'nullable|array',
        ]);

        $service->update($request, $id);
        return redirect()->route('worksample.index')->with('success', 'تم التحديث بنجاح');
    }

}
