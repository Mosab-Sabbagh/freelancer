@extends('jobPoster.layouts.app')

@section('title', 'مشاريعي')

@section('content')
<div class="container main-container">
    <div class="row">
        <div class="col-lg-3">
            <div class="filter-section">
                <h5>الفرز حسب</h5>
                <form id="filterForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label d-block mb-2">حالة المشروع</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status[]" value="" id="statusAll">
                            <label class="form-check-label" for="statusAll">الكل</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status[]" value="open" id="statusOpen">
                            <label class="form-check-label" for="statusOpen">نشط</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status[]" value="pending" id="statusPending">
                            <label class="form-check-label" for="statusPending">قيد الانتظار</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="status[]" value="closed" id="statusClosed">
                            <label class="form-check-label" for="statusClosed">مغلق</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block mb-2">الترتيب</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sort[]" value="newest" id="sortNewest">
                            <label class="form-check-label" for="sortNewest">الأحدث</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sort[]" value="oldest" id="sortOldest">
                            <label class="form-check-label" for="sortOldest">الأقدم</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sort[]" value="price-high" id="sortPriceHigh">
                            <label class="form-check-label" for="sortPriceHigh">السعر الأعلى</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sort[]" value="price-low" id="sortPriceLow">
                            <label class="form-check-label" for="sortPriceLow">السعر الأقل</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row g-3">
                @foreach ($projects as $project)
                    <div class="col-md-6 d-flex">
                        <div class="project-card mb-4 p-4 border rounded-3 shadow-sm bg-white flex-fill w-100">
                            <div class="d-flex justify-content-between align-items-start">
                                <a href="{{route('poster.project.applications',$project->id)}}"><h4 class="project-title">{{$project->title}}</h4></a>
                                @if($project->status === 'open')
                                <span class="badge bg-success">نشط</span>
                                @elseif($project->status === 'pending')
                                    <span class="badge bg-warning"> قيد التنفيذ</span>
                                @elseif($project->status === 'closed')
                                    <span class="badge bg-success"> مكتمل</span>
                                @else 
                                    <span class="badge bg-danger">مغلق</span>
                                @endif
                            </div>
                            <div class="project-details">
                                <div class="row">
                                    <div class="col-12">
                                        <p><strong>الميزانية:</strong> <span class="project-budget">
                                            {{ $project->budget_from ?? '---' }} - {{ $project->budget_to ?? '---' }} $</span></p>
                                        <p><strong>المدة:</strong> {{$project->deadline}}</p>
                                        <p><strong>المرفقات:</strong> 
                                            @if($project->attachment)
                                                <a href="{{ asset('storage/' . $project->attachment) }}" target="_blank">عرض المرفق</a>
                                            @else
                                                لا يوجد
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection