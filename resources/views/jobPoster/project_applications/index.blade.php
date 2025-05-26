@extends('jobPoster.layouts.app')

@section('title', 'عرض الطلبات')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-dark mb-5">الطلبات المقدمة للمشروع</h1>

    <div class="row">
        @forelse($applications as $application)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm rounded-lg h-100 border-0">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 pb-3 border-bottom">
                            <div class="mb-3 mb-md-0">
                                <h2 class="h5 font-weight-semibold text-dark mb-1">
                                    <i class="fas fa-user-circle text-primary me-2"></i>
                                    {{ $application->jobSeeker->user->name }} {{ $application->jobSeeker->user->last_name }}
                                </h2>
                                <p class="text-muted small">
                                    <i class="fas fa-envelope text-secondary me-1"></i>
                                    {{ $application->jobSeeker->user->email ?? 'لا يوجد بريد إلكتروني' }}
                                </p>
                            </div>
                            <div class="text-start text-md-end">
                                @if($application->is_selected)
                                    <span class="badge bg-primary text-white py-2 px-3 rounded-pill">
                                        <i class="fas fa-check-circle me-2"></i> مختار حالياً
                                    </span>
                                @elseif($application->execution_status === 'in_progress')
                                    <span class="badge bg-success text-white py-2 px-3 rounded-pill">
                                        <i class="fas fa-hourglass-half me-2"></i> قيد التنفيذ
                                    </span>
                                @elseif($application->execution_status === 'rejected')
                                    <span class="badge bg-danger text-white py-2 px-3 rounded-pill">
                                        <i class="fas fa-times-circle me-2"></i> مرفوض
                                    </span>
                                @else
                                    <span class="badge bg-secondary text-white py-2 px-3 rounded-pill">
                                        <i class="fas fa-clock me-2"></i> بانتظار المراجعة
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <p class="text-dark font-weight-medium mb-1">
                                    <i class="fas fa-file-alt text-info me-2"></i> العرض:
                                </p>
                                <p class="text-dark bg-light p-3 rounded border border-light small lh-base">
                                    {{ $application->notes ?? 'لا يوجد عرض مكتوب.' }}
                                </p>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <p class="text-dark font-weight-medium mb-1">
                                        <i class="fas fa-calendar-alt text-warning me-2"></i> أيام التنفيذ المقترحة:
                                    </p>
                                    <p class="text-dark font-weight-bold h6">
                                        {{ $application->execution_days ?? 'غير محدد' }} أيام
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="text-dark font-weight-medium mb-1">
                                    <i class="fas fa-dollar-sign text-success me-2"></i> السعر المقترح:
                                </p>
                                <p class="text-dark font-weight-bold h6">
                                    {{ $application->proposed_price ?? 'غير محدد' }} $
                                </p>
                            </div>
                        </div>

                        <div class="mt-auto d-flex flex-column flex-sm-row justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('profile.show', $application->jobSeeker->user->id) }}"
                                class="btn btn-outline-primary btn-md d-flex align-items-center justify-content-center">
                                <i class="fas fa-address-card me-2"></i> عرض الملف الشخصي
                            </a>

                            @if(!$application->is_selected)
                                <form action="{{ route('poster.project.select', $application->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-success btn-md d-flex align-items-center justify-content-center">
                                        <i class="fas fa-check me-2"></i> اختيار
                                    </button>
                                </form>
                            @else
                                <button type="button" disabled
                                        class="btn btn-secondary btn-md d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check-double me-2"></i> تم الاختيار بالفعل
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    <strong class="font-weight-bold">عذراً!</strong>
                    لا توجد طلبات مقدمة لهذا المشروع حتى الآن.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection