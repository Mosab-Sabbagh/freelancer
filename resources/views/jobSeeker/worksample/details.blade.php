@php
    $currentLayout = 'jobSeeker.layouts.app'; 
    $navPartial = 'jobSeeker.layouts.nav';   

    if (Auth::check()) {
        if (Auth::user()->jobPoster) {
            $currentLayout = 'jobPoster.layouts.app';
        }
    }
@endphp

@extends($currentLayout)
@section('title')
تفاصيل المشروع 
@endsection 

@section('content')


    <div class="container py-5">
        <div class="project-header text-center justify-content-between">
            <h1 class="project-title">{{$work->title}}</h1>
            <div class="project-meta">
                <span class="me-3"><i class="fas fa-calendar"></i>{{$work->project_date}}</span>
                <span class="me-3"><i class="fas fa-tag"></i> الفئة: {{$work->category}} </span>
            </div>
            @if (Auth::user()->jobSeeker && Auth()->id() == $work->user_id)
                <div class="mt-2">
                    <a href="{{route('worksample.edit',$work->id)}}" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{route('worksample.destroy',$work->id)}}" method="post" class="delete-form" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger delete-user">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endif
        </div>


        <div class="row">
            <div class="col-lg-8">
                <div class="project-description">
                    <h2 class="mb-4">وصف المشروع</h2>
                    <p  style="white-space: pre-line;">{{$work->description }}</p>
                </div>

                        <div class="project-gallery">
            <h2 class="mb-4">معرض الصور</h2>
            <div id="workSampleCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($work->files as $index => $item)
                <div class="carousel-item @if($index == 0) active @endif">
                    <div class="d-flex justify-content-center align-items-center" style="height:400px;">
                    <img src="{{ asset('storage/'.$item->file_path) }}" class="d-block" style="max-width: 100%; max-height: 100%;" alt="صورة المشروع {{$index+1}}">
                    </div>
                </div>
                @endforeach
            </div>
            @if(count($work->files) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#workSampleCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1); background-color: black; border-radius: 50%;"></span>
                <span class="visually-hidden">السابق</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#workSampleCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1); background-color: black; border-radius: 50%;"></span>
                <span class="visually-hidden" >التالي</span>
            </button>
            @endif
            </div>
        </div>
            </div>

            <!-- معلومات المشروع -->
            <div class="col-lg-4">
                <div class="project-info">
                    <h3 class="mb-4">معلومات المشروع</h3>
                    <div class="info-item">
                        <h5>المدة الزمنية</h5>
                        <p>{{$work->duration}}</p>
                    </div>
                    <div class="info-item">
                        <h5>التقنيات المستخدمة</h5>
                        <p>{{$work->technologies}}</p>
                    </div>
                    <div class="info-item">
                        <h5>معاينة</h5>
                        <p><a href="javascript:;" class="text-decoration-none">{{$work->preview_link}}</a></p>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
@endsection

@section('style')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }
    .project-header {
        background-color: #fff;
        padding: 2rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .project-title {
        color: #2c3e50;
        margin-bottom: 1rem;
    }
    .project-meta {
        color: #666;
        font-size: 0.9rem;
    }
    .project-gallery {
        margin-bottom: 2rem;
    }
    .gallery-item {
        margin-bottom: 1rem;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .project-description {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .project-info {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .info-item {
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #eee;
    }
    .info-item:last-child {
        border-bottom: none;
    }
</style>
@endsection
