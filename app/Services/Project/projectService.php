<?php 
namespace App\Services\Project;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class projectService {
    public function createProject(array $data)  
    {
        $attachmentPath = null;

        if (isset($data['attachment']) && $data['attachment']->isValid()) {
            $attachmentPath = $data['attachment']->store('attachments', 'public');
        }

        return Project::create([
            'job_poster_id' => Auth::user()->jobPoster->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'budget_from' => $data['budget_from'],
            'budget_to' => $data['budget_to'],
            'deadline' => $data['deadline'],
            'service_id' => $data['service_id'],
            'attachment' => $attachmentPath,
            'status' => 'open',
        ]);
    }

    public function getProjectsForCurrentUser()
    {
        return Project::where('job_poster_id', Auth::user()->jobPoster->id)->get();
    }

    public  function filterProjects($request)
    {
        return Project::query()
            ->withCount('applications')  // إذا كنت تحتاج عد المقترحات
            ->with('service')        // فقط العلاقات الضرورية
            ->when($request->filled('service_id'), function ($query) use ($request) {
                $query->whereIn('service_id', (array)$request->service_id);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('title', 'like', '%'.$request->search.'%');
            })
            ->latest()
            ->paginate(20)
            ->appends($request->query()); // للحفاظ على معايير البحث في الروابط
    }


    public function detailsProject($id)
    {
        return Project::findOrFail($id);
    }




}