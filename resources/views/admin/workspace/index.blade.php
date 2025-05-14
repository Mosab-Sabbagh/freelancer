@extends('admin.layouts.app')

@section('title', 'مساحات العمل')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">إضافة مساحة عمل جديدة</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.workspace.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="owner_name" class="form-label">اسم المالك أو المساحة</label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="governorate" class="form-label">المحافظة</label>
                                        <input type="text" class="form-control" id="governorate" name="governorate" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">العنوان</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="available_time" class="form-label">الوقت المتاح</label>
                                        <input type="text" class="form-control" id="available_time" name="available_time" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus ml-1"></i>
                                إضافة
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">قائمة مساحات العمل</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المساحة</th>
                                        <th>المحافظة</th>
                                        <th>العنوان</th>
                                        <th>رقم الجوال</th>
                                        <th>الوقت المتاح</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($workspaces as $workspace)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $workspace->owner_name }}</td>
                                            <td>{{ $workspace->governorate }}</td>
                                            <td>{{ $workspace->address }}</td>
                                            <td>{{ $workspace->phone_number }}</td>
                                            <td>{{ $workspace->available_time }}</td>
                                            <td>
                                                <a href="{{route('admin.workspace.edit', $workspace->id)}}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{route('admin.workspace.destroy', $workspace->id)}}" method="post" class="d-inline delete-form" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" >
                                                        <i class="fas fa-trash"></i>
                                                    </button>   
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted">لا يوجد مهارات</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $workspaces->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection