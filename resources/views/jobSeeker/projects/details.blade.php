@extends('jobSeeker.layouts.app')

@section('title', 'تفاصيل المشروع')
@section('content')
    <div class="container main-container">
        <div class="row">
            <div class="col-lg-8">
                <div class="project-card mb-4 p-4 border rounded-3 shadow-sm bg-white">
                    <h4 class="project-title fw-bold mb-3">تفاصيل المشروع</h4>
                    <p class="project-description mb-4" style="white-space: pre-line;">
                        {{ $project->description }}
                    </p>
    
                    @if($project->attachment)
                        <h5 class="mb-2">مرفقات</h5>
                        <p class="project-attachment mb-4">
                            <a href="{{ asset('storage/' . $project->attachment) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-paperclip me-1"></i> عرض المرفق
                            </a>
                        </p>
                    @endif
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="apply-form-card p-4 border rounded-3 shadow-sm bg-white">
                            <h4 class="fw-bold mb-4">تقديم عرض للمشروع</h4>
                            <form action="{{route('project.application.store',$project->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="job_poster_id" value="{{$project->jobPoster->id}}">
                                <div class="d-flex justify-content-between">
                                <div class="mb-3">
                                    <label for="deliveryTime" class="form-label">مدة التسليم <span style="color: red">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="execution_days" id="deliveryTime" placeholder="0" required>
                                        <span class="input-group-text">أيام</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deliveryPrice" class="form-label"> قيمة العرض <span style="color: red">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="proposed_price" id="deliveryPrice" placeholder="0" required>
                                        <span class="input-group-text">$</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="offerAmount" class="form-label">مستحقاتك </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="offerAmount" placeholder="0.00" value="" readonly>
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <small class="text-muted" >بعد خصم <span style="color: #3498db">عمولة موقع وظيفة</span></small>
                                </div>
                            </div>
                                <div class="mb-3">
                                    <label for="offerDetails" class="form-label">تفاصيل عرضك <span style="color: red">*</span></label>
                                    <textarea class="form-control" name="notes" id="offerDetails" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-apply">
                                    <i class="fas fa-paper-plane me-1"></i> تقديم عرض
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
    
            <div class="col-lg-4">
                <div class="project-card-sidebar mb-4 p-4 border rounded-3 shadow-sm bg-white">
                    <h5 class="fw-bold mb-3">بطاقة المشروع</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">حالة المشروع</span>
                        <span class="badge bg-success">مفتوح</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">تاريخ النشر</span>
                        <span class="small">{{ $project->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">الميزانية</span>
                        <span class="small text-success fw-bold">{{ $project->budget_from }} - {{ $project->budget_to }} $</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted small">مدة التنفيذ</span>
                        <span class="small">
                            @if($project->created_at && $project->deadline)
                                {{ floor(Carbon\Carbon::parse($project->created_at)->diffInDays(Carbon\Carbon::parse($project->deadline))) }} يوم
                            @else
                                غير محدد
                            @endif
                        </span>
                    </div>
    
                    <h5 class="fw-bold mb-3">الخدمة المطلوبة</h5>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-light text-dark border">{{ $project->service->name }}</span>
                    </div>
    
                    <h5 class="fw-bold mb-3">صاحب المشروع</h5>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="small"><i class="fas fa-user-circle me-1"></i>{{ $project->jobPoster->company?->name ??$project->jobPoster->user->name .' ' . $project->jobPoster->user->last_name}}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">تاريخ التسجيل</span>
                        <span class="small">{{ $project->jobPoster->user->created_at->format('d M Y') }}</span>
                    </div>
            </div>
        </div>
    </div>
</div>

    
@endsection
