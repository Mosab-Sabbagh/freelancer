@extends('admin.layouts.app')

@section('title', 'مساحات العمل')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">تعديل مساحة العمل </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.workspace.update',$workspace->id)}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="owner_name" class="form-label">اسم المالك أو المساحة</label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ $workspace->owner_name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="governorate" class="form-label">المحافظة</label>
                                        <input type="text" class="form-control" id="governorate" name="governorate" value="{{ $workspace->governorate }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">العنوان</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $workspace->address }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="available_time" class="form-label">الوقت المتاح</label>
                                        <input type="text" class="form-control" id="available_time" name="available_time" value="{{ $workspace->available_time }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $workspace->phone_number }}" required>
                                    </div>
                                </div>
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