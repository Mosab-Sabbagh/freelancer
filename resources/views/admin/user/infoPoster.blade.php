@extends('admin.layouts.app')
@section('title', 'معلومات حول ' . $user->name)

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right ml-1"></i>
            رجوع
        </a>
    </div>

    @if ($poster && $poster->company)
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        @if( $poster->company->logo)
                            <img src="{{ asset('storage/' . $poster->company->logo) }}" 
                                class="rounded-circle mb-3"
                                style="width: 200px; height: 200px; object-fit: cover;"
                                alt="صورة المستخدم">
                        @else
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light"
                                    style="width: 200px; height: 200px;">
                                <i class="fas fa-user fa-4x text-muted"></i>
                            </div>
                        @endif
                        <h4 class="mb-0">{{$poster->company->name}}</h4>
                        <p class="text-muted">{{$poster->company->email}}</p>
                        <p>صاحب الشركة: {{$poster->user->name}} {{$poster->user->last_name}}</p>
                        <p>بريد صاحب الشركة: {{$poster->user->email}}</p>
                    </div>
                </div>
            </div>
    
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="card-title mb-3"><i class="fas fa-info-circle"></i> نبذة عن الشركة</h5>
                                <p class="card-text " style="white-space: pre-line;">{{$poster->company->description}}</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="row mb-4 card-body">
                        <div class="col-md-4">
                            <div class="info-item">
                                <div class="col-md-12">
                                    <h5 class="text-muted"><i class="fas fa-phone"></i>رقم الجوال </h5>
                                    <p class="card-text">{{$poster->company->phone}}</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="info-item">
                                <div class="col-md-12">
                                    <h5 class="text-muted"><i class="fas fa-link"></i>موقع الشركة الالكتروني   </h5>
                                    <p class="card-text">{{$poster->company->website}}</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="info-item">
                                <div class="col-md-12">
                                    <h5 class="text-muted"><i class="fas fa-map"></i>مقر الشركة </h5>
                                    <p class="card-text">{{$poster->company->address}}</p>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>

    @elseif($poster && $poster->user)
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        @if( $poster->profile_image)
                            <img src="{{ asset('storage/' . $poster->profile_image) }}" 
                                class="rounded-circle mb-3"
                                style="width: 200px; height: 200px; object-fit: cover;"
                                alt="صورة المستخدم">
                        @else
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light"
                                    style="width: 200px; height: 200px;">
                                <i class="fas fa-user fa-4x text-muted"></i>
                            </div>
                        @endif
                        <h4 class="mb-0">{{$poster->user->name}} {{$poster->user->last_name}}</h4>
                        <p class="text-muted">{{$poster->user->email}}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="card-title mb-3"><i class="fas fa-info-circle"></i> نبذة شخصية</h5>
                                <p class="card-text " style="white-space: pre-line;">{{$poster->bio}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="card-title mb-3"><i class="fas fa-phone"></i>رقم الجوال </h5>
                                <p class="card-text">{{$poster->phone}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card shadow mt-4">
        <h3 class="text-center mt-2" style="color:#03356a;">المشاريع المنشورة</h3>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان الخدمة/المشروع</th>
                            <th>تصنيف الخدمة</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (filled($poster->projects))
                            @foreach ($poster->projects as $project)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td> {{$project->title}} </td>
                                    <td> {{$project->service->name}} </td>
                                    <td>
                                        @if($project->status === 'open')
                                        <span class="badge bg-success">نشط</span>
                                        @elseif($project->status === 'pending')
                                        <span class="badge bg-warning"> قيد التنفيذ</span>
                                        @else 
                                        <span class="badge bg-danger">مغلق</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td class="text-center" style="row-span: 3">لا أعمال منشورة</td>
                                </tr>
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
</div>


</div>
@endsection