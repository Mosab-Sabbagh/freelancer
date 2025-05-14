@extends('admin.layouts.app')

@section('title', 'تعديل المهارة')
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">تعديل المهارة</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.skill.update', $skill->id)}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">اسم المهارة</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $skill->name }}" required>
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
