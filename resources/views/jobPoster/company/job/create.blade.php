@extends('jobPoster.layouts.app')

@section('title' , 'إضافة وظيفة')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">إضافة وظيفة جديدة</h2>

    <form action="{{ route('job.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}" placeholder="عنوان الوظيفة">
            <label for="title">عنوان الوظيفة</label>
        </div>

        <div class="form-floating mb-3">
            <textarea name="description" class="form-control" rows="30" required placeholder="وصف الوظيفة">{{ old('description') }}</textarea>
            <label for="description">وصف الوظيفة</label>
        </div>

        <div class="form-group mb-3">
            <label for="service_id">نوع الوظيفة - المجال-</label>
            <select name="service_id" class="form-control" required>
                <option value="">-- اختر مجال --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="">نوع الوظيفة</label>
            <input type="radio" name="job_type" value="full_time" id=""> دوام كلي
            <input type="radio" name="job_type" value="part_time" id=""> جزئي
        </div>

        <div class="form-floating mb-3">
            <input type="number" step="1" name="salary_amount" class="form-control" value="{{ old('budget_from') }}" placeholder="الراتب">
            <label for="salary_amount">الراتب</label>
        </div>


        <div class="form-group mb-3">
            <label for="deadline">موعد انتهاء التقديم</label>
            <input type="date"  name="deadline" class="form-control" value="{{ old('deadline') }}">
        </div>



        <button type="submit" class="btn btn-primary">نشر الوظيفة</button>
    </form>
</div>
@endsection
