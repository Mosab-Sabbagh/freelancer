@extends('jobPoster.layouts.app')
@section('style')

@endsection
@section('title')
    {{Auth::user()->name}} لوحة تحكم
@endsection

@section('content')
    <div class="container main-container">
        <div class="row">

            <!-- الجزء الجانبي -->
            <div class="col-lg-4 ">
                <div class="">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            
                            @if($company)
                                {{-- عرض بيانات الشركة --}}
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" 
                                        class="rounded-circle mb-3"
                                        style="width: 200px; height: 200px; object-fit: cover;"
                                        alt="شعار الشركة">
                                @else
                                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light"
                                        style="width: 200px; height: 200px;">
                                        <i class="fas fa-building fa-4x text-muted"></i>
                                    </div>
                                @endif
            
                                <h4 class="mb-0">{{ $company->name }}</h4>
                                <p class="text-muted">{{ $company->email }}</p>
            
                            @else
                                {{-- عرض بيانات المستخدم الفرد --}}
                                @if($user->jobPoster->profile_image)
                                    <img src="{{ asset('storage/' . $user->jobPoster->profile_image) }}" 
                                        class="rounded-circle mb-3"
                                        style="width: 200px; height: 200px; object-fit: cover;"
                                        alt="صورة المستخدم">
                                @else
                                    <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light"
                                        style="width: 200px; height: 200px;">
                                        <i class="fas fa-user fa-4x text-muted"></i>
                                    </div>
                                @endif
            
                                <h4 class="mb-0">{{ $user->name }} {{ $user->last_name }}</h4>
                                <p class="text-muted">{{ $user->email }}</p>
                            @endif
            
                            <a href="{{ route('jobposter.edit') }}" class="btn btn-primary btn-sm">تعديل الملف الشخصي</a>
                        </div>
                    </div>
                </div>
            </div>
            



            <!-- البطاقات المالية -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-money-bill-wave"></i>  عدد المشاريع المضافة
                            </div>
                            <div class="card-body">
                                <div class="amount">{{$totalProjects}}</div>
                                <small class="text-muted">   مشروع </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-chart-pie"></i>  عدد المشاريع الملغية
                            </div>
                            <div class="card-body">
                                <div class="amount">{{$totalProjectsClosed}}</div>
                                <small class="text-muted">مشروع</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4"></div>
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-building"></i> آخر المشاريع التي أضفتها
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($latestProjects as $item)
                                    <div class="col-12 mb-3">
                                        <h5>{{$item->title}}</h5>
                                        <p class="text-muted"> الفئة: <span class="text-success">{{$item->service->name}}</span> </p>
                                        {{-- <small class="text-muted">{{$item->description}} </small> --}}
                                        
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div> 
        </div>
    </div>
@endsection