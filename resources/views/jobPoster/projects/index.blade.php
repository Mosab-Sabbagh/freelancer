@extends('jobPoster.layouts.app')

@section('title')
    مشاريعي
@endsection

@section('content')
<div class="container mt-5">

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <i class="fas fa-tasks fa-2x text-primary"></i>
                <div class="stats-number">12</div>
                <div class="stats-label">المشاريع النشطة</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <i class="fas fa-check-circle fa-2x text-success"></i>
                <div class="stats-number">25</div>
                <div class="stats-label">المشاريع المكتملة</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <i class="fas fa-money-bill-wave fa-2x text-primary"></i>
                <div class="stats-number">45,000 $</div>
                <div class="stats-label">إجمالي المدفوعات</div>
            </div>
        </div>
    </div>

    <div class="filter-section">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">حالة المشروع</label>
                <select class="form-select" name="status">
                    <option value="">الكل</option>
                    <option value="open">نشط</option>
                    <option value="pending">قيد الانتظار</option>
                    <option value="closed">مغلق</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">الترتيب</label>
                <select class="form-select">
                    <option value="newest">الأحدث</option>
                    <option value="oldest">الأقدم</option>
                    <option value="price-high">السعر الأعلى</option>
                    <option value="price-low">السعر الأقل</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @foreach ($projects as $project)
                <div class="project-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <h4 class="project-title">{{$project->title}}</h4>
                        @if($project->status === 'open')
                        <span class="badge bg-success">نشط</span>
                        @elseif($project->status === 'pending')
                            <span class="badge bg-warning"> قيد التنفيذ</span>
                        @else 
                            <span class="badge bg-danger">مغلق</span>
                        @endif
                    </div>
                    <div class="project-details">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>الميزانية:</strong> <span class="project-budget">
                                    {{ $project->budget_from ?? '---' }} - {{ $project->budget_to ?? '---' }} $</span></p>
                                <p><strong>المدة:</strong> {{$project->deadline}}</p>
                            </div>
                            <div>
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
            @endforeach
        </div>
    </div>
</div>
@endsection