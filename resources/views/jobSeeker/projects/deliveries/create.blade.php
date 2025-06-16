@extends('jobSeeker.layouts.app')
@section('title', 'تسليم المشروع')
@section('content')
    <div class="container py-5">
        <div class="card">
            <div class="card-header">
                تسليم المشروع: {{ $project->title }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('deliveries.store', $project) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="delivery_notes" class="form-label">ملاحظات التسليم</label>
                        <textarea class="form-control" id="delivery_notes" name="delivery_notes" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="delivery_file" class="form-label">إرفاق ملف (اختياري)</label>
                        <input class="form-control" type="file" id="delivery_file" name="delivery_file">
                    </div>

                    <button type="submit" class="btn btn-primary">تسليم المشروع</button>
                </form>
            </div>
        </div>
    </div>
@endsection