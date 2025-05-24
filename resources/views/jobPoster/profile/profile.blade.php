@extends('jobPoster.layouts.app')
@section('title')
    الملف الشخصي - {{ Auth::user()->name }} 
@endsection

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right ml-1"></i>
            رجوع
        </a>
        <a href="{{route('jobposter.edit')}}" class="btn btn-primary btn-sm">تعديل الملف الشخصي</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    @if( $jobPoster->profile_image)
                        <img src="{{ asset('storage/' . $jobPoster->profile_image) }}" 
                            class="rounded-circle mb-3"
                            style="width: 200px; height: 200px; object-fit: cover;"
                            alt="صورة المستخدم">
                    @else
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light"
                                style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-4x text-muted"></i>
                        </div>
                    @endif
                    <h4 class="mb-0">{{Auth::user()->name}} {{Auth::user()->last_name}}</h4>
                    <p class="text-muted">{{Auth::user()->email}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="card-title mb-3"><i class="fas fa-info-circle"></i> نبذة شخصية</h5>
                            <p class="card-text " style="white-space: pre-line;">{{$jobPoster->bio}}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="card-title mb-3"><i class="fas fa-phone"></i>رقم الجوال </h5>
                            <p class="card-text">{{$jobPoster->phone}}</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection