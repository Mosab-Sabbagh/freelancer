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

    public static function filterProjects($request)
    {
        $query = Project::query();
        
        // فلترة حسب الخدمات
        if ($request->has('service_id') && !empty($request->service_id)) {
            $query->whereIn('service_id', $request->service_id);
        }
        
        // فلترة حسب البحث
        if ($request->has('search') && !empty($request->search)) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }
        
        return $query->paginate(20);
    }


    public function detailsProject($id)
    {
        return Project::findOrFail($id);
    }




}