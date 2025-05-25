<?php

namespace App\Http\Controllers\ProjectApplication;

use App\Http\Controllers\Controller;
use App\Services\Project\ProjectApplicationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectApplicationController extends Controller
{
    public function store(ProjectApplicationService $projectApplicationService, Request $request,$project_id)
    {
        try{
            $validated = $request->validate([
                'proposed_price' => 'required|numeric|min:1',
                'execution_days' => 'required|integer|min:1',
                'notes' => 'required'
            ]);

            $jobSeekerId = Auth::user()->jobSeeker->id;

            if ($projectApplicationService->hasAlreadyApplied($project_id, $jobSeekerId)) {
                return redirect()->back()->with('error', 'لقد قمت بتقديم عرض لهذا المشروع مسبقاً.');
            }
        
            $projectApplicationService->storeApplication([
                'project_id'    => $project_id,
                'job_seeker_id' => $jobSeekerId,
                'job_poster_id' => $request->job_poster_id,
                'proposed_price'=> $validated['proposed_price'],
                'execution_days' => $validated['execution_days'],
                'notes' => $validated['notes'],
                'status'        => 'pending', // حالة مبدئية
                'is_selected'   => false,
            ]);
        
            return redirect()->back()->with('success', 'تم إرسال العرض بنجاح');
        }catch(Exception $e){
            Log::info($e);
            return redirect()->back()->with('error', 'هناك خطأ ما حاول مرة أخرى');
        }
    }
}
