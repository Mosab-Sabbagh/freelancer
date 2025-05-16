
@extends('jobSeeker.layouts.app')
@section('title')
إضافة عمل
@endsection
@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header text-white" style="background-color: #3cbede;">
                <h5 class="mb-0">إضافة مشروع جديد</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('worksample.update',$work->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="title" class="form-label"> عنوان المشروع </label>
                        <input type="text" name="title" class="form-control" placeholder="عنوان المشروع" value="{{ old('title', $work->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label"> وصف المشروع </label>
                        <textarea name="description" class="form-control" placeholder="وصف المشروع لا يقل عن 30 كلمة" required>{{ old('description',$work->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label"> التاريخ </label>
                            <input type="date" name="project_date" class="form-control" value="{{ old('project_date',$work->project_date) }}"  required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الملفات/الصور الحالية:</label>
                            <div class="row">
                                @foreach ($work->files as $file)
                                    <div class="col-md-3 text-center">
                                        @if(Str::endsWith($file->file_path, ['jpg','jpeg','png']))
                                            <img src="{{ asset('storage/' . $file->file_path) }}" class="img-fluid rounded mb-1" style="max-height: 120px;">
                                        @else
                                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">📄 عرض ملف</a>
                                        @endif

                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="delete_files[]" value="{{ $file->id }}" id="deleteFile{{ $file->id }}">
                                            <label class="form-check-label" for="deleteFile{{ $file->id }}">
                                                حذف
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="files" class="form-label">رفع ملفات جديدة (اختياري):</label>
                            <input type="file" name="files[]" class="form-control" multiple>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="technologies" class="form-label">التقنيات المستخدمة</label>
                            <input type="text" name="technologies" class="form-control" id="technologies" placeholder="Laravel, Vue.js, MySQL" value="{{ old('technologies',$work->technologies) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="preview_link" class="form-label">رابط المعاينة <span style="color: rgba(255, 0, 0, 0.491)">(ان وجد)</span></label>
                            <input type="text" name="preview_link" class="form-control" id="preview_link" placeholder="https://example.com/demo" value="{{ old('preview_link',$work->preview_link) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="duration" class="form-label">المدة الزمنية</label>
                            <input type="text" name="duration" class="form-control" id="duration" placeholder="3 شهور" value="{{ old('duration',$work->duration) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">الفئة</label>
                            <input type="text" name="category" class="form-control" id="category" placeholder="ويب / موبايل / تصميم..." value="{{ old('category',$work->category) }}" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">تعديل</button>
                    <a href="{{ route('jobSeeker.dash') }}" class="btn btn-secondary ms-2">إلغاء</a>
                </form>
            </div>
        </div>
    </div>
@endsection