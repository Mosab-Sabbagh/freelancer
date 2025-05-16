<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Services\JobSeeker\WorkSamplesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class WorkSamplesController extends Controller
{
    public function add()
    {
        try {
            return view('jobSeeker.worksample.add');
        } catch (Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التحميل: ');
        }
    }
    
    public function store(Request $request, WorkSamplesService $service)
    {
        try {
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
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء الإضافة: ' );
        }
    }

    public function index(WorkSamplesService $service)
    {
        try {
            $WorkSamples = $service->getAll();
            return view('jobSeeker.worksample.index', compact("WorkSamples"));
        } catch (Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التحميل: ' );
        }
    }

    public function show(WorkSamplesService $service, $id)
    {
        try {
            $work = $service->getById($id);
            return view('jobSeeker.worksample.details', compact("work"));
        } catch (Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التحميل: ' );
        }
    }

    public function destroy(WorkSamplesService $service, $id)
    {
        try {
            $service->delete($id);
            return redirect()->route('worksample.index')->with('success','تم حذف المشروع بنجاح');
        } catch (Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء الحذف: ' );
        }
    }

    public function edit(WorkSamplesService $service, $id)
    {
        try {
            $work = $service->getById($id);
            return view('jobSeeker.worksample.edit', compact('work'));
        } catch (Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء التحميل: ' );
        }
    }

    public function update(Request $request, $id, WorkSamplesService $service)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'project_date' => 'nullable|date',
                'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'delete_files' => 'nullable|array',
            ]);

            $service->update($request, $id);
            return redirect()->route('worksample.index')->with('success', 'تم التحديث بنجاح');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'حدث خطأ أثناء التحديث: ');
        }
    }
}
