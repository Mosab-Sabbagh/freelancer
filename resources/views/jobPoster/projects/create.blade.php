@extends('jobPoster.layouts.app')

@section('title')
    اضافة مشروع
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">إضافة مشروع جديد</h2>

    <form action="{{ route('jobposter.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="title">عنوان المشروع</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="form-group mb-3">
            <label for="description">تفاصيل المشروع</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="service_id">نوع الخدمة</label>
            <select name="service_id" class="form-control" required>
                <option value="">-- اختر خدمة --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group mb-3">
            <label for="skills">المهارات المطلوبة</label>
            <select name="skills[]" class="form-control" multiple>
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}" {{ collect(old('skills'))->contains($skill->id) ? 'selected' : '' }}>
                        {{ $skill->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">يمكنك اختيار أكثر من مهارة</small>
        </div> --}}

        <div class="form-group mb-3">
            <label for="status">حالة المشروع</label>
            <select name="status" class="form-control" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>متاح</option>
                <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>مغلق</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="budget_from">الميزانية (من)</label>
            <input type="number" step="0.01" name="budget_from" class="form-control" value="{{ old('budget_from') }}">
        </div>

        <div class="form-group mb-3">
            <label for="budget_to">الميزانية (إلى)</label>
            <input type="number" step="0.01" name="budget_to" class="form-control" value="{{ old('budget_to') }}">
        </div>

        <div class="form-group mb-3">
            <label for="deadline">موعد الاستلام</label>
            <input type="date"  name="deadline" class="form-control" value="{{ old('deadline') }}">
        </div>

        <div class="form-group">
            <label for="attachment">أرفق توضيحاً (اختياري):</label>
            <input type="file" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
        </div>


        <button type="submit" class="btn btn-primary">إضافة المشروع</button>
    </form>
</div>
@endsection
