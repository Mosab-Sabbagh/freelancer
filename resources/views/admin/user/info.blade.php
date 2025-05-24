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
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    @if($seeker && $seeker->profile_picture)
                        <img src="{{ asset('storage/' . $seeker->profile_picture) }}" 
                             class="rounded-circle mb-3"
                             style="width: 200px; height: 200px; object-fit: cover;"
                             alt="صورة المستخدم">
                    @else
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light"
                             style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-4x text-muted"></i>
                        </div>
                    @endif
                    <h4 class="mb-0">{{$user->name}} {{$user->last_name}}</h4>
                    <p class="text-muted">{{$user->email}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            @if ($seeker)
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="card-title mb-3"><i class="fas fa-info-circle"></i> نبذة شخصية</h5>
                            <p class="card-text" style="white-space: pre-line;">{{$seeker->bio}}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="info-item">
                                <h6 class="text-muted">الحالة</h6>
                                <p class="mb-0">
                                    <span class="badge {{ $seeker->is_available ? 'bg-success' : 'bg-danger' }}">
                                        {{ $seeker->is_available ? 'متاح' : 'غير متاح' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <h6 class="text-muted">سعر الساعة</h6>
                                <p class="mb-0">{{$seeker->hourly_rate}} دولار</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item">
                                <h6 class="text-muted">مستوى الخبرة</h6>
                                <p class="mb-0">
                                    @if($seeker->experience_level == 'beginner')
                                        مبتدئ
                                    @elseif($seeker->experience_level == 'intermediate')
                                        متوسط
                                    @else
                                        محترف
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3"><i class="fas fa-briefcase"></i> مجالات العمل</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($seeker->services as $service)
                                    <span class="badge bg-primary">{{$service->name}}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-3"><i class="fas fa-tools"></i> المهارات</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($seeker->skills as $skill)
                                    <span class="badge bg-secondary">{{$skill->name}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> لم يتم تسجيل البيانات بعد
            </div>
            @endif
        </div>
    </div>
</div>
@endsection