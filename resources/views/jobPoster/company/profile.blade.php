@extends('jobPoster.layouts.app')
@section('title')
    الملف الشخصي - {{ $companyPoster->name }} 
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
                    @if( $companyPoster->logo)
                        <img src="{{ asset('storage/' . $companyPoster->logo) }}" 
                            class="rounded-circle mb-3"
                            style="width: 200px; height: 200px; object-fit: cover;"
                            alt="صورة المستخدم">
                    @else
                        <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center bg-light"
                                style="width: 200px; height: 200px;">
                            <i class="fas fa-user fa-4x text-muted"></i>
                        </div>
                    @endif
                    <h4 class="mb-0">{{$companyPoster->name}}</h4>
                    <p class="text-muted">{{$companyPoster->email}}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="card-title mb-3"><i class="fas fa-info-circle"></i> نبذة عن الشركة</h5>
                            <p class="card-text " style="white-space: pre-line;">{{$companyPoster->description}}</p>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 card-body">
                    <div class="col-md-4">
                        <div class="info-item">
                            <div class="col-md-12">
                                <h5 class="text-muted"><i class="fas fa-phone"></i>رقم الجوال </h5>
                                <p class="card-text">{{$companyPoster->phone}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-item">
                            <div class="col-md-12">
                                <h5 class="text-muted"><i class="fas fa-link"></i>موقع الشركة الالكتروني   </h5>
                                <p class="card-text">{{$companyPoster->website}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-item">
                            <div class="col-md-12">
                                <h5 class="text-muted"><i class="fas fa-map"></i>مقر الشركة </h5>
                                <p class="card-text">{{$companyPoster->address}}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection