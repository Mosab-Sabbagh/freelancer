<?php 
namespace App\Services\JobSeeker;

use App\Models\WorkSample;
use App\Models\WorkSampleFile;
use App\Models\Workspace;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkSamplesService{

    public function __construct(protected FileUploadService $uploadService) {}


    public function handleStore(Request $request)
    {
        $workSample = $this->createWorkSample($request);
        $this->uploadWorkSampleFiles($workSample, $request->file('files'));
    }

    protected function createWorkSample(Request $request)
    {
        return WorkSample::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'project_date' => $request->project_date,
            'technologies'=> $request->technologies,
            'preview_link'=> $request->preview_link,
            'duration'=> $request->duration,
            'category'=> $request->category,
        ]);
    }


    protected function uploadWorkSampleFiles(WorkSample $workSample, ?array $files)
    {
        if (!$files) return;
        $isFirst = true;
        foreach ($files as $file) {
            $path = $this->uploadService->uploadSingle($file, 'work_samples');
            $workSample->files()->create([
                'file_path' => $path,
                'is_main' => $isFirst,
            ]);
            $isFirst = false;
        }
    }

    public function getAll($id)
    {
        return WorkSample::with('mainImage')->where('user_id',$id)->get();
    }

    public function getById($id)
    {
        return WorkSample::with('files')->findOrFail($id);
    }

    public function delete($id)
    {
        $work  =  WorkSample::find($id);
        if($work->user_id !== Auth::id())
            return;
        foreach ($work->files as $file) {
            if (Storage::disk('public')->exists($file->file_path)) {
                Storage::disk('public')->delete($file->file_path);
            }
        }
        $work->delete();
    }

    public function update(Request $request, $id)
    {
        $workSample = WorkSample::with('files')->findOrFail($id);
        if($workSample->user_id !== Auth::id())
            return;
        // تحديث البيانات الأساسية
        $workSample->update([
            'title' => $request->title,
            'description' => $request->description,
            'project_date' => $request->project_date,
            'technologies' => $request->technologies,
            'preview_link' => $request->preview_link,
            'duration' => $request->duration,
            'category' => $request->category,

        ]);

        // حذف الملفات المختارة
        if ($request->has('delete_files')) {
            foreach ($request->delete_files as $fileId) {
                $file = WorkSampleFile::find($fileId);
                if ($file && Storage::disk('public')->exists($file->file_path)) {
                    Storage::disk('public')->delete($file->file_path);
                    $file->delete();
                }
            }
        }

        // رفع ملفات جديدة
        if ($request->hasFile('files')) {
            $isMain = !$workSample->files()->where('is_main', true)->exists(); // لو ما في صورة رئيسية
            foreach ($request->file('files') as $file) {
                $path = Storage::disk('public')->put('work_samples', $file);
                $workSample->files()->create([
                    'file_path' => $path,
                    'is_main' => $isMain,
                ]);
                $isMain = false;
            }
        }

        return $workSample;
    }

}