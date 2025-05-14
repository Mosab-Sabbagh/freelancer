@extends('admin.layouts.app')

@section('title', 'تعديل الخدمة')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">تعديل الخدمة</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.service.update', $service->id)}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">اسم الخدمة</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus ml-1"></i>
                                تعديل
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
