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
@section('title','معرض الأعمال')
@section('content')
<div class="container main-container">
    <div class="row">
        @forelse ($WorkSamples as $work)
            <div class="col-md-3 mb-3">
                <a href="{{route('worksample.show',$work->id)}}" class="text-decoration-none">
                    <div class="portfolio-card h-100">
                        <div class="portfolio-image" style="height: 300px; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                            <img src="{{ $work->mainImage ? asset('storage/' . $work->mainImage->file_path) : asset('images/default.jpg') }}"
                                alt="صورة المشروع"
                                class="img-fluid rounded"
                                style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                    </a>
                        <h4 class="portfolio-title text-center mt-3">{{$work->title}}</h4>
            </div>
        </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    <strong class="font-weight-bold">عذراً!</strong>
                    لا توجد مشاريع مضافة لحد الان .
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection