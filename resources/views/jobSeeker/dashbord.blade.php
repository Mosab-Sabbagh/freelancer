@extends('jobSeeker.layouts.app')
@section('style')

@endsection
@section('title')
    لوحة تحكم -{{$user->name}}
@endsection

@section('content')
    <div class="container main-container">
        @if (session(('status')))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
        <div class="row">

            <!-- الجزء الجانبي -->
            <div class="col-lg-4 ">

                <div class="">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            @if($jobSeeker->profile_picture)
                                <img src="{{ asset('storage/' . $jobSeeker->profile_picture) }}" 
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
                            <a href="{{route('jobSeeker.profile.edit',$user->id)}}" class="btn btn-primary btn-sm">تعديل الملف الشخصي</a>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        <h5 class="card-title fw-bold mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-lightbulb text-warning me-2"></i> نصيحة لزيادة فرصك
                        </h5>
                        <p class="card-text text-muted mb-4">
                            "احرص على أن يكون معرض أعمالك (Portfolio) محدثاً ويعكس أفضل مشاريعك. إنه مفتاح إبهار العملاء!"
                        </p>
                        <a href="{{route('worksample.index')}}" class="btn btn-sm btn-outline-primary">
                            تحديث معرض الأعمال <i class="fas fa-arrow-alt-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>


            </div>

            <!-- البطاقات المالية -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-money-bill-wave"></i> الرصد القابل للسحب
                            </div>
                            <div class="card-body">
                                <div class="amount">$0.00</div>
                                <small class="text-muted">المبلغ المتاح للسحب الفوري</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-chart-pie"></i> الرصد الكلي
                            </div>
                            <div class="card-body">
                                <div class="amount">$0.00</div>
                                <small class="text-muted">إجمالي الرصيد بما فيه المحجوز</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4"></div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-building me-2"></i> آخر المشاريع
                            </div>
                            <div>
                                <a href="{{ route('jobseeker.projects.index') }}" class="btn btn-primary">
                                    تصفح كافة المشاريع <i class="fas fa-arrow-alt-circle-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse ($latestProjects as $project)
                                    <div class="col-12 mb-3">
                                        <a href="{{ route('project.details', $project->id) }}" class="text-decoration-none text-dark">
                                            <h5 class="fw-bold mb-0">{{ $project->title }}</h5>
                                        </a>
                                        <small class="text-muted">
                                            <i class="fas fa-user-circle me-1"></i> {{ $project->jobPoster->company?->name ?? $project->jobPoster->user->name }}
                                            <span class="ms-2 me-2">|</span>
                                            منذ {{ $project->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted text-center">لا توجد مشاريع حديثة في مجالك حالياً.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection