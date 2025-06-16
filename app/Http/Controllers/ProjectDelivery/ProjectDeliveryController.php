<?php

namespace App\Http\Controllers\ProjectDelivery;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Project;
use App\Models\ProjectDelivery;
use App\Services\Project\ProjectDeliveryService;
use Illuminate\Http\Request;

class ProjectDeliveryController extends Controller
{
    use AuthorizesRequests;

    public function create(Project $project)
    {
        $this->authorize('deliver', $project);
        return view('jobSeeker.projects.deliveries.create', compact('project'));
    }

    public function store(Request $request, Project $project, ProjectDeliveryService $service)
    {
        $this->authorize('deliver', $project);

        $data = $request->validate([
            'delivery_notes' => 'required|string',
            'delivery_file' => 'nullable|file|mimes:zip,rar,docx,pdf',
        ]);

        if ($request->hasFile('delivery_file')) {
            $data['delivery_file'] = $request->file('delivery_file');
        }

        try {
            $service->storeDelivery($project, $data);
            return redirect()->route('jobSeeker.dash')->with('success', 'تم تسليم المشروع بنجاح');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function confirm(ProjectDelivery $delivery, ProjectDeliveryService $service)
    {
        $service->confirmDelivery($delivery);

        return redirect()->back()->with('success', 'تم تأكيد استلام المشروع بنجاح.');
    }

}
