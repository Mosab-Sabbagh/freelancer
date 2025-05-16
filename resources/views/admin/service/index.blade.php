@extends('admin.layouts.app')

@section('title', 'عرض الخدمات')
@section('content')



<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">إضافة خدمة جديدة</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.service.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم الخدمة</label>
                            <input type="text" class="form-control" id="name" name="name" required>
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
                    <h5 class="mb-0">قائمة الخدمات</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الخدمة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($services as $service)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>
                                            <a href="{{route('admin.service.edit', $service->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{route('admin.service.destroy', $service->id)}}" method="post" class="d-inline delete-form" style="display: inline-block;">
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
                                        <td colspan="2" class="text-center text-muted">لا يوجد خدمات</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- {{ $services->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

