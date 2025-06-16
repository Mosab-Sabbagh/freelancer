<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Services\Jobs\JobApplicationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JobApplicationController extends Controller
{
    public function store(Request $request , JobApplicationService $jobApplicationService, $job_id)
    {
        try{
            $validated = $request->validate([
                'notes' => 'required',
            ]);
            
            $jobSeekerId = Auth::user()->jobSeeker->id;

            if ($jobApplicationService->hasAlreadyApplied($job_id, $jobSeekerId)) {
                return redirect()->back()->with('error', 'لقد قمت بتقديم عرض لهذه الوظيفة مسبقاً.');
            }

            $jobApplicationService->storeJobApplication([
                'job_id' => $job_id,
                'job_seeker_id' => $jobSeekerId,
                'company_id' => $request->company_id,
                'notes' => $validated['notes'],
                'status' => 'pending',
                'is_selected'=> false,
            ]);

            return redirect()->back()->with('success', 'تم تقديم الطلب بنجاح');

        }catch(Exception $e){
            Log::info($e);
            return redirect()->back()->with('error', 'هناك خطأ ما حاول مرة أخرى');
        }
    }

    public function showForJob($jobId, JobApplicationService $jobApplicationService)
    {
        try {
            $applications = $jobApplicationService->getApplicationsForJob($jobId);
            return view('jobPoster.company.job_applications.index', compact('applications'));
        } catch (Exception $e) {
            Log::info($e);
            return redirect()->back()->with('error', 'حدث خطأ أثناء جلب الطلبات');
        }
    }

    public function select(JobApplicationService $jobApplicationService,$id)
    {
        try {
            $jobApplicationService->selectApplication($id, Auth::user()->jobPoster->company->id);

            return redirect()->back()->with('success', 'تم اختيار المستقل للوظيفة  بنجاح.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'الطلب أو الوظيفة المطلوب غير موجود.');
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            abort(403, $e->getMessage());
        } catch (Exception $e) {
            Log::info($e);
            return redirect()->back()->with('error', 'حدث خطأ أثناء اختيار المستقل: ' . $e->getMessage());
        }
    }
}
