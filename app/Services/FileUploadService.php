<?php 
namespace App\Services;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class FileUploadService{
    /**
     * ارفع ملف واحد
     */
    public function uploadSingle(UploadedFile $file, string $folder = 'uploads', string $disk = 'public'): string
    {
        return $file->store($folder, $disk);
    }

    /**
     * ارفع عدة ملفات
     */
    public function uploadMultiple(array $files, string $folder = 'uploads', string $disk = 'public'): array
    {
        $paths = [];

        foreach ($files as $file) {
            $paths[] = $this->uploadSingle($file, $folder, $disk);
        }

        return $paths;
    }

    /**
     * حذف ملف
     */
    public function delete(string $path, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->exists($path) 
            ? Storage::disk($disk)->delete($path)
            : false;
    }
}